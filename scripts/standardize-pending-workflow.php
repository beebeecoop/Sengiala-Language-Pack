<?php

declare(strict_types=1);

/**
 * Standardize selected Malay pending-workflow labels from
 * "Untuk + passive verb" to "Perlu + passive verb".
 *
 * This tool uses an explicit key map. It intentionally does not replace
 * descriptive or purpose phrases such as "fail untuk dimuat turun",
 * "akaun untuk digunakan", or "baris untuk dipautkan".
 *
 * Usage:
 *   php scripts/standardize-pending-workflow.php --check
 *   php scripts/standardize-pending-workflow.php --apply
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-pending-workflow.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . 'ms_MY';
if (!is_dir($root)) {
    fwrite(STDERR, "Directory not found: {$root}\n");
    exit(2);
}

$replacements = [
    'TransactionsToConciliateShort' => ['Untuk disesuaikan', 'Perlu Disesuaikan'],
    'ToConciliate' => ['Untuk disesuaikan?', 'Perlu Disesuaikan?'],
    'PaymentStatusToValidShort' => ['Untuk Disahkan', 'Perlu Disahkan'],
    'MenuToValid' => ['Untuk disahkan', 'Perlu Disahkan'],
    'LastProspectToContact' => ['Untuk dihubungi', 'Perlu Dihubungi'],
    'StatusProspect1' => ['Untuk dihubungi', 'Perlu Dihubungi'],
    'ToDispatch' => ['Untuk diagihkan', 'Perlu Diagihkan'],
    'InvoiceNotLate' => ['Untuk dikutip (< 15 hari)', 'Perlu Dikutip (< 15 hari)'],
    'InvoiceNotLate15Days' => ['Untuk dikutip (15 hingga 30 hari)', 'Perlu Dikutip (15 hingga 30 hari)'],
    'InvoiceNotLate30Days' => ['Untuk dikutip (> 30 hari)', 'Perlu Dikutip (> 30 hari)'],
    'InvoiceToPay' => ['Untuk dibayar (< 15 hari)', 'Perlu Dibayar (< 15 hari)'],
    'InvoiceToPay15Days' => ['Untuk dibayar (15 hingga 30 hari)', 'Perlu Dibayar (15 hingga 30 hari)'],
    'InvoiceToPay30Days' => ['Untuk dibayar (> 30 hari)', 'Perlu Dibayar (> 30 hari)'],
    'BoardNotActivatedServicesShort' => ['Perkhidmatan untuk diaktifkan', 'Perkhidmatan Perlu Diaktifkan'],
    'ActionRunningNotStarted' => ['Untuk dimulakan', 'Perlu Dimulakan'],
    'StatusToPay' => ['Untuk dibayar', 'Perlu Dibayar'],
    'ValidatedToProduce' => ['Disahkan (Untuk dihasilkan)', 'Disahkan (Perlu Dihasilkan)'],
    'ToRefuse' => ['Untuk ditolak', 'Perlu Ditolak'],
    'ToApprove' => ['Untuk diluluskan', 'Perlu Diluluskan'],
    'ToConsume' => ['Untuk Digunakan', 'Perlu Digunakan'],
    'ToProduce' => ['Untuk Dihasilkan', 'Perlu Dihasilkan'],
    'ToObtain' => ['Untuk Diperoleh', 'Perlu Diperoleh'],
    'StatusOrderToProcessShort' => ['Untuk diproses', 'Perlu Diproses'],
    'StatusSupplierOrderToProcessShort' => ['Untuk diproses', 'Perlu Diproses'],
    'StockToBuy' => ['Untuk dipesan', 'Perlu Dipesan'],
    'ToComplete' => ['Untuk Dilengkapkan', 'Perlu Dilengkapkan'],
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
echo sprintf("\n%s: %d pending workflow correction(s) across %d file(s).\n", $verb, $total, count($matchedFiles));

exit(0);
