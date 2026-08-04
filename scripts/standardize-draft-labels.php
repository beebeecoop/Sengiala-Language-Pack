<?php

declare(strict_types=1);

/**
 * Standardize selected Malay draft noun labels from "Kata Nama Draf"
 * to "Draf + Kata Nama".
 *
 * This tool intentionally uses an explicit key map. It does not perform a
 * repository-wide blind replacement because phrases such as "status Draf",
 * "bukan draf", and prose describing draft state are contextually correct.
 *
 * Usage:
 *   php scripts/standardize-draft-labels.php --check
 *   php scripts/standardize-draft-labels.php --apply
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-draft-labels.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . 'ms_MY';
if (!is_dir($root)) {
    fwrite(STDERR, "Directory not found: {$root}\n");
    exit(2);
}

$replacements = [
    'DraftCommercialProposals' => ['Sebut Harga Komersial Draf', 'Draf Sebut Harga Komersial'],
    'DraftVendorProposals' => ['Sebut Harga Pembekal Draf', 'Draf Sebut Harga Pembekal'],
    'DraftPurchaseOrders' => ['Pesanan Pembekal Draf', 'Draf Pesanan Pembekal'],
    'DraftContract' => ['Kontrak Draf', 'Draf Kontrak'],
    'DraftSupplierOrders' => ['Pesanan Pembekal Draf', 'Draf Pesanan Pembekal'],
    'DraftInvoice' => ['Invois Draf', 'Draf Invois'],
    'DraftProject' => ['Projek Draf', 'Draf Projek'],
    'DraftProposals' => ['Sebut Harga Draf', 'Draf Sebut Harga'],
    'ProposalsDraft' => ['Sebut Harga Pelanggan Draf', 'Draf Sebut Harga Pelanggan'],
    'DraftOrders' => ['Pesanan draf', 'Draf Pesanan'],
    'DraftSuppliersOrders' => ['Pesanan belian draf', 'Draf Pesanan Belian'],
    'DraftSupplierProposals' => ['Sebut Harga Pembekal Draf', 'Draf Sebut Harga Pembekal'],
];

$files = glob($root . DIRECTORY_SEPARATOR . '*.lang') ?: [];
$total = 0;
$changedFiles = 0;
$errors = [];

foreach ($files as $file) {
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        $errors[] = "Unable to read {$file}";
        continue;
    }

    $changed = false;

    foreach ($lines as $index => $line) {
        if ($line === '' || str_starts_with(ltrim($line), '#')) {
            continue;
        }

        $separator = strpos($line, '=');
        if ($separator === false || $separator < 1) {
            continue;
        }

        $key = substr($line, 0, $separator);
        if (!array_key_exists($key, $replacements)) {
            continue;
        }

        [$expectedOld, $expectedNew] = $replacements[$key];
        $value = substr($line, $separator + 1);

        if ($value === $expectedNew) {
            continue;
        }

        if ($value !== $expectedOld) {
            $relative = str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR, '', $file);
            $errors[] = "Unexpected value for {$key} in {$relative}: {$value}";
            continue;
        }

        $total++;
        $relative = str_replace(dirname(__DIR__) . DIRECTORY_SEPARATOR, '', $file);
        echo sprintf("%s:%d %s: %s -> %s\n", $relative, $index + 1, $key, $expectedOld, $expectedNew);

        if ($mode === '--apply') {
            $lines[$index] = $key . '=' . $expectedNew;
            $changed = true;
        }
    }

    if ($mode === '--apply' && $changed) {
        $content = implode(PHP_EOL, $lines) . PHP_EOL;
        if (file_put_contents($file, $content) === false) {
            $errors[] = "Unable to write {$file}";
        } else {
            $changedFiles++;
        }
    }
}

if ($errors !== []) {
    foreach ($errors as $error) {
        fwrite(STDERR, "ERROR: {$error}\n");
    }
    exit(1);
}

$verb = $mode === '--apply' ? 'APPLIED' : 'FOUND';
echo sprintf("\n%s: %d draft label correction(s) across %d file(s).\n", $verb, $total, $mode === '--apply' ? $changedFiles : count(array_unique(array_map(
    static fn(string $line): string => strtok($line, ':'),
    []
))));

exit(0);
