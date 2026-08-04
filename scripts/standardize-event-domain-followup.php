<?php

declare(strict_types=1);

/**
 * Runtime Correction Batch 7 — Event-domain follow-up.
 *
 * Completes multi-phrase corrections that cannot be represented safely by
 * the initial single-pair mapping in standardize-agenda-event.php.
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-event-domain-followup.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__);

$mapping = [
    'lang/ms_MY/admin.lang' => [
        'Module600Long' => [
            ['Acara Agenda', 'Perkara Agenda'],
        ],
        'Permission2401' => [
            ['pemilik acara', 'pemilik perkara'],
        ],
        'Permission2402' => [
            ['pemilik acara', 'pemilik perkara'],
        ],
        'Permission2403' => [
            ['pemilik acara', 'pemilik perkara'],
        ],
    ],
    'lang/ms_MY/modulebuilder.lang' => [
        'TriggerDefDesc' => [
            ['acara yang dicetuskan oleh modul lain', 'peristiwa yang dicetuskan oleh modul lain'],
        ],
    ],
];

$total = 0;
$filesChanged = 0;

foreach ($mapping as $relativePath => $entries) {
    $path = $root . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
    if (!is_file($path)) {
        fwrite(STDERR, "Missing file: {$relativePath}\n");
        exit(1);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        fwrite(STDERR, "Unable to read: {$relativePath}\n");
        exit(1);
    }

    $fileCount = 0;

    foreach ($lines as $index => $line) {
        if ($line === '' || str_starts_with(ltrim($line), '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        if (!isset($entries[$key])) {
            continue;
        }

        $updated = $value;
        $lineCount = 0;

        foreach ($entries[$key] as [$old, $new]) {
            if (!str_contains($updated, $old)) {
                continue;
            }

            $updated = str_replace($old, $new, $updated, $count);
            $lineCount += $count;
        }

        if ($lineCount < 1) {
            continue;
        }

        printf(
            "%s:%d %s: %s -> %s\n",
            str_replace('/', DIRECTORY_SEPARATOR, $relativePath),
            $index + 1,
            $key,
            $value,
            $updated
        );

        $total += $lineCount;
        $fileCount += $lineCount;

        if ($mode === '--apply') {
            $lines[$index] = $key . '=' . $updated;
        }
    }

    if ($fileCount > 0) {
        $filesChanged++;

        if ($mode === '--apply') {
            $content = implode(PHP_EOL, $lines) . PHP_EOL;
            if (file_put_contents($path, $content) === false) {
                fwrite(STDERR, "Unable to write: {$relativePath}\n");
                exit(1);
            }
        }
    }
}

printf(
    "\n%s: %d event-domain follow-up correction(s) across %d file(s).\n",
    $mode === '--apply' ? 'APPLIED' : 'FOUND',
    $total,
    $filesChanged
);

exit(0);
