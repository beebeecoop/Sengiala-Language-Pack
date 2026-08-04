<?php

declare(strict_types=1);

/**
 * Standardize Malay bank matching terminology.
 *
 * Conciliate / Reconcile families are expressed consistently as:
 * - Padan
 * - Pemadanan
 * - Dipadankan
 *
 * Pending workflow labels use "Perlu + passive verb".
 * Explicit key mapping prevents unrelated uses of words such as
 * "sesuai", "penyesuaian", or general-purpose "untuk" from changing.
 *
 * Usage:
 *   php scripts/standardize-bank-matching.php --check
 *   php scripts/standardize-bank-matching.php --apply
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-bank-matching.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . 'ms_MY';
if (!is_dir($root)) {
    fwrite(STDERR, "Directory not found: {$root}\n");
    exit(2);
}

$replacements = [
    'ACCOUNTING_BANK_CONCILIATED' => [
        'Pindahkan ke Perakaunan hanya baris yang telah disesuaikan dalam Penyata Bank (secara lalai, boleh dinyahtanda pada setiap pindahan)',
        'Pindahkan ke Perakaunan hanya baris yang telah dipadankan dalam Penyata Bank (secara lalai, boleh dinyahtanda pada setiap pindahan)',
    ],
    'Reconcilable' => ['Boleh Dipadankan', 'Boleh Dipadankan'],
    'NotReconciled' => ['Belum Disesuaikan', 'Belum Dipadankan'],
    'FECFormatReconcilableCode' => ['Kod Boleh Disesuaikan (EcritureLet)', 'Kod Boleh Dipadankan (EcritureLet)'],
    'FECFormatReconcilableDate' => ['Tarikh Penyesuaian (DateLet)', 'Tarikh Pemadanan (DateLet)'],
    'Reconciliation' => ['Penyesuaian', 'Pemadanan'],
    'BankReconciliation' => ['Penyesuaian Bank', 'Pemadanan Bank'],
    'Reconciled' => ['Telah Disesuaikan', 'Telah Dipadankan'],
    'Unreconciled' => ['Belum Disesuaikan', 'Belum Dipadankan'],
    'Delays_MAIN_DELAY_TRANSACTIONS_TO_CONCILIATE' => ['Penyesuaian Bank tertangguh', 'Pemadanan Bank Tertangguh'],
    'TransactionsToConciliate' => ['Catatan untuk disesuaikan', 'Catatan Perlu Dipadankan'],
    'TransactionsToConciliateShort' => ['Perlu Disesuaikan', 'Perlu Dipadankan'],
    'Conciliable' => ['Boleh disesuaikan', 'Boleh Dipadankan'],
    'Conciliate' => ['Sesuaikan', 'Padankan'],
    'Conciliation' => ['Penyesuaian', 'Pemadanan'],
    'ReconciliationLate' => ['Penyesuaian Lewat', 'Pemadanan Lewat'],
    'DisableConciliation' => ['Lumpuhkan ciri Penyesuaian bagi akaun ini', 'Lumpuhkan ciri Pemadanan bagi akaun ini'],
    'ConciliationDisabled' => ['Ciri Penyesuaian dilumpuhkan', 'Ciri Pemadanan dilumpuhkan'],
    'LinkedToAConciliatedTransaction' => ['Dipautkan kepada Catatan yang Telah Disesuaikan', 'Dipautkan kepada Catatan yang Telah Dipadankan'],
    'Conciliated' => ['Telah Disesuaikan', 'Telah Dipadankan'],
    'ReConciliedBy' => ['Disesuaikan oleh', 'Dipadankan oleh'],
    'DateConciliating' => ['Tarikh Penyesuaian', 'Tarikh Pemadanan'],
    'BankLineConciliated' => ['Catatan telah disesuaikan dengan resit bank', 'Catatan telah dipadankan dengan resit bank'],
    'TransfertOnlyConciliatedBankLine' => ['Pindahkan hanya baris bank yang telah disesuaikan', 'Pindahkan hanya baris bank yang telah dipadankan'],
    'BankLineReconciled' => ['Telah Disesuaikan', 'Telah Dipadankan'],
    'BankLineNotReconciled' => ['Belum Disesuaikan', 'Belum Dipadankan'],
    'ToConciliate' => ['Perlu Disesuaikan?', 'Perlu Dipadankan?'],
    'IfYouDontReconcileDisableProperty' => [
        'Jika anda tidak membuat Penyesuaian Bank bagi sesetengah Akaun Bank, lumpuhkan sifat "%s" pada akaun tersebut untuk membuang amaran ini.',
        'Jika anda tidak membuat Pemadanan Bank bagi sesetengah Akaun Bank, lumpuhkan sifat "%s" pada akaun tersebut untuk membuang amaran ini.',
    ],
    'XNewLinesConciliated' => ['%s baris baru telah disesuaikan', '%s baris baru telah dipadankan'],
    'CantRemoveConciliatedPayment' => ['Tidak boleh membuang Bayaran yang telah disesuaikan', 'Tidak boleh membuang Bayaran yang telah dipadankan'],
    'Reconcile' => ['Sesuaikan', 'Padankan'],
    'ReconciliationDate' => ['Tarikh Penyesuaian', 'Tarikh Pemadanan'],
    'ErrorCantDeletePaymentReconciliated' => [
        'Tidak boleh menghapus Bayaran yang telah menjana Catatan Bank yang telah disesuaikan',
        'Tidak boleh menghapus Bayaran yang telah menjana Catatan Bank yang telah dipadankan',
    ],
    'SubscriptionLinkedToConciliatedTransaction' => [
        'Keanggotaan dipautkan kepada transaksi yang telah dipadankan, jadi pengubahsuaian ini tidak dibenarkan.',
        'Keanggotaan dipautkan kepada transaksi yang telah dipadankan, jadi pengubahsuaian ini tidak dibenarkan.',
    ],
    'Gp23NetProfitReconciliationDifference' => [
        'Perbezaan rekonsiliasi keuntungan bersih',
        'Perbezaan pemadanan keuntungan bersih',
    ],
];

$files = glob($root . DIRECTORY_SEPARATOR . '*.lang') ?: [];
$total = 0;
$matchedFiles = [];
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

        if ($expectedOld === $expectedNew) {
            continue;
        }

        $total++;
        $matchedFiles[$file] = true;
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
echo sprintf("\n%s: %d bank matching correction(s) across %d file(s).\n", $verb, $total, count($matchedFiles));

exit(0);
