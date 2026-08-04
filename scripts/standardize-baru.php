<?php

declare(strict_types=1);

/**
 * Runtime Correction Batch 3 — Repository-wide Baru Standardisation.
 *
 * Usage:
 *   php scripts/standardize-baru.php --check
 *   php scripts/standardize-baru.php --apply
 *
 * Safety rules:
 * - scans only lang/ms_MY/*.lang;
 * - changes only the value portion after the first '=';
 * - replaces standalone Baharu -> Baru and baharu -> baru;
 * - preserves words such as Pembaharuan, Perbaharui, Diperbaharui,
 *   memperbaharui and their derivatives;
 * - preserves keys, placeholders, HTML and line endings.
 */

$mode = $argv[1] ?? '--check';

if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-baru.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__);
$langDirectory = $root . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . 'ms_MY';
$files = glob($langDirectory . DIRECTORY_SEPARATOR . '*.lang');

if ($files === false || $files === []) {
    fwrite(STDERR, "No language files found in {$langDirectory}\n");
    exit(2);
}

sort($files, SORT_STRING);

$totalChanges = 0;
$changedFiles = 0;
$report = [];

foreach ($files as $file) {
    $content = file_get_contents($file);

    if ($content === false) {
        fwrite(STDERR, "Unable to read {$file}\n");
        exit(2);
    }

    $hasTrailingNewline = str_ends_with($content, "\n");
    $lines = preg_split('/\R/', $content);

    if ($lines === false) {
        fwrite(STDERR, "Unable to split {$file}\n");
        exit(2);
    }

    $fileChanges = 0;

    foreach ($lines as $index => $line) {
        $trimmed = ltrim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#')) {
            continue;
        }

        $separator = strpos($line, '=');

        if ($separator === false || $separator === 0) {
            continue;
        }

        $key = substr($line, 0, $separator);
        $value = substr($line, $separator + 1);

        $updatedValue = preg_replace_callback(
            '/(?<![\p{L}\p{N}_])(Baharu|baharu)(?![\p{L}\p{N}_])/u',
            static fn (array $match): string => $match[1] === 'Baharu' ? 'Baru' : 'baru',
            $value,
            -1,
            $replacementCount
        );

        if ($updatedValue === null) {
            fwrite(STDERR, "Regex failure in {$file} at line " . ($index + 1) . "\n");
            exit(2);
        }

        if ($replacementCount === 0) {
            continue;
        }

        $lines[$index] = $key . '=' . $updatedValue;
        $fileChanges += $replacementCount;
        $totalChanges += $replacementCount;
        $report[] = sprintf(
            '%s:%d %s (%d)',
            str_replace($root . DIRECTORY_SEPARATOR, '', $file),
            $index + 1,
            $key,
            $replacementCount
        );
    }

    if ($fileChanges === 0) {
        continue;
    }

    $changedFiles++;

    if ($mode === '--apply') {
        $updatedContent = implode(PHP_EOL, $lines);

        if ($hasTrailingNewline && !str_ends_with($updatedContent, PHP_EOL)) {
            $updatedContent .= PHP_EOL;
        }

        if (file_put_contents($file, $updatedContent) === false) {
            fwrite(STDERR, "Unable to write {$file}\n");
            exit(2);
        }
    }
}

foreach ($report as $entry) {
    echo $entry, PHP_EOL;
}

echo PHP_EOL;
echo sprintf(
    "%s: %d standalone replacement(s) across %d file(s).\n",
    $mode === '--apply' ? 'APPLIED' : 'FOUND',
    $totalChanges,
    $changedFiles
);

if ($mode === '--check' && $totalChanges > 0) {
    exit(1);
}

exit(0);
