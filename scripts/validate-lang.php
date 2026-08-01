<?php

declare(strict_types=1);

/**
 * Baseline validator for Dolibarr .lang files.
 *
 * Usage:
 *   php scripts/validate-lang.php lang/ms_MY/bills.lang
 */

if ($argc < 2) {
    fwrite(STDERR, "Usage: php scripts/validate-lang.php <file.lang> [more.lang ...]\n");
    exit(2);
}

$hasErrors = false;

foreach (array_slice($argv, 1) as $path) {
    if (!is_file($path) || !is_readable($path)) {
        fwrite(STDERR, "ERROR {$path}: file not found or unreadable.\n");
        $hasErrors = true;
        continue;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        fwrite(STDERR, "ERROR {$path}: unable to read file.\n");
        $hasErrors = true;
        continue;
    }

    $keys = [];
    $fileErrors = [];

    foreach ($lines as $index => $line) {
        $lineNumber = $index + 1;
        $trimmed = trim($line);

        if ($trimmed === '' || str_starts_with($trimmed, '#')) {
            continue;
        }

        $separator = strpos($line, '=');
        if ($separator === false) {
            $fileErrors[] = "line {$lineNumber}: missing '=' separator";
            continue;
        }

        $key = trim(substr($line, 0, $separator));
        $value = substr($line, $separator + 1);

        if ($key === '') {
            $fileErrors[] = "line {$lineNumber}: empty key";
            continue;
        }

        if (!preg_match('/^[A-Za-z0-9_.-]+$/', $key)) {
            $fileErrors[] = "line {$lineNumber}: invalid key '{$key}'";
        }

        if (isset($keys[$key])) {
            $fileErrors[] = "line {$lineNumber}: duplicate key '{$key}' (first seen on line {$keys[$key]})";
        } else {
            $keys[$key] = $lineNumber;
        }

        if ($value === '') {
            $fileErrors[] = "line {$lineNumber}: empty value for '{$key}'";
        }
    }

    if ($fileErrors === []) {
        fwrite(STDOUT, "PASS {$path}: " . count($keys) . " keys validated.\n");
        continue;
    }

    $hasErrors = true;
    fwrite(STDERR, "FAIL {$path}:\n");
    foreach ($fileErrors as $error) {
        fwrite(STDERR, "  - {$error}\n");
    }
}

exit($hasErrors ? 1 : 0);
