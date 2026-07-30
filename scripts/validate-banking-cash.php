<?php

declare(strict_types=1);

/**
 * M2-02 Banking & Cash Foundation validator.
 *
 * Validates required terminology and cross-file consistency for the
 * Dolibarr banking baseline and the SengialaSuite cash compatibility layer.
 */

$root = dirname(__DIR__);
$files = [
    'banks' => $root . '/lang/ms_MY/banks.lang',
    'cash' => $root . '/lang/ms_MY/cash.lang',
];

/**
 * @return array<string, string>
 */
function loadLanguageFile(string $path): array
{
    if (!is_file($path)) {
        throw new RuntimeException("Language file not found: {$path}");
    }

    $terms = [];
    $lines = file($path, FILE_IGNORE_NEW_LINES);

    if ($lines === false) {
        throw new RuntimeException("Unable to read language file: {$path}");
    }

    foreach ($lines as $lineNumber => $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#')) {
            continue;
        }

        if (!str_contains($line, '=')) {
            throw new RuntimeException(sprintf(
                'Invalid language entry in %s at line %d',
                $path,
                $lineNumber + 1
            ));
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        if ($key === '' || $value === '') {
            throw new RuntimeException(sprintf(
                'Empty key or value in %s at line %d',
                $path,
                $lineNumber + 1
            ));
        }

        if (array_key_exists($key, $terms)) {
            throw new RuntimeException("Duplicate key {$key} in {$path}");
        }

        $terms[$key] = $value;
    }

    return $terms;
}

/**
 * @param array<string, string> $terms
 * @param array<string, string> $required
 * @return list<string>
 */
function validateRequiredTerms(array $terms, array $required, string $label): array
{
    $errors = [];

    foreach ($required as $key => $expected) {
        if (!array_key_exists($key, $terms)) {
            $errors[] = "{$label}: missing required key {$key}";
            continue;
        }

        if ($terms[$key] !== $expected) {
            $errors[] = sprintf(
                '%s: %s must be "%s"; found "%s"',
                $label,
                $key,
                $expected,
                $terms[$key]
            );
        }
    }

    return $errors;
}

try {
    $banks = loadLanguageFile($files['banks']);
    $cash = loadLanguageFile($files['cash']);
} catch (RuntimeException $exception) {
    fwrite(STDERR, "FAIL {$exception->getMessage()}" . PHP_EOL);
    exit(1);
}

$errors = [];

if (count($banks) < 200) {
    $errors[] = sprintf('banks.lang: expected at least 200 keys; found %d', count($banks));
}

if (count($cash) < 35) {
    $errors[] = sprintf('cash.lang: expected at least 35 keys; found %d', count($cash));
}

$errors = array_merge(
    $errors,
    validateRequiredTerms($banks, [
        'BankAccount' => 'Akaun Bank',
        'CashAccount' => 'Akaun Tunai',
        'BankTransaction' => 'Catatan Bank',
        'Reconciliation' => 'Penyelarasan',
        'Conciliate' => 'Selaraskan',
        'Conciliated' => 'Telah Diselaraskan',
        'BankLineNotReconciled' => 'Belum Diselaraskan',
        'BankTransfer' => 'Pindahan Kredit',
        'MenuBankInternalTransfer' => 'Pindahan Dalaman',
        'StandingOrder' => 'Arahan Debit Terus',
    ], 'banks.lang'),
    validateRequiredTerms($cash, [
        'CashAccount' => 'Akaun Tunai',
        'CashBook' => 'Buku Tunai',
        'CashReceipt' => 'Penerimaan Tunai',
        'CashPayment' => 'Bayaran Tunai',
        'PettyCash' => 'Wang Tunai Runcit',
        'InternalTransfer' => 'Pindahan Dalaman',
        'Reconciliation' => 'Penyelarasan',
        'Reconcile' => 'Selaraskan',
        'Reconciled' => 'Telah Diselaraskan',
        'Unreconciled' => 'Belum Diselaraskan',
    ], 'cash.lang')
);

foreach (['CashAccount', 'CashAccounts', 'Reconciliation'] as $sharedKey) {
    if (($banks[$sharedKey] ?? null) !== ($cash[$sharedKey] ?? null)) {
        $errors[] = sprintf(
            'Cross-file mismatch for %s: banks.lang="%s", cash.lang="%s"',
            $sharedKey,
            $banks[$sharedKey] ?? '<missing>',
            $cash[$sharedKey] ?? '<missing>'
        );
    }
}

if ($errors !== []) {
    fwrite(STDERR, "FAIL M2-02 Banking & Cash Foundation" . PHP_EOL);

    foreach ($errors as $error) {
        fwrite(STDERR, "- {$error}" . PHP_EOL);
    }

    exit(1);
}

printf(
    "PASS M2-02 Banking & Cash Foundation: %d banking keys and %d cash keys validated.%s",
    count($banks),
    count($cash),
    PHP_EOL
);
