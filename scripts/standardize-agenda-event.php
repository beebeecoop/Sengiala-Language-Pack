<?php

declare(strict_types=1);

/**
 * Runtime Correction Batch 7 — Agenda Event Terminology.
 *
 * Standardizes Event/Acara to Perkara only for Dolibarr Agenda semantics.
 * Business events, security events, triggers, webhooks, event organization,
 * conferences and public events are intentionally excluded.
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-agenda-event.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__);

$mapping = [
    'lang/ms_MY/admin.lang' => [
        'Module600Long' => ['Acara Agenda', 'Perkara Agenda'],
        'Module2400Name' => ['Acara/Agenda', 'Perkara/Agenda'],
        'Module2400Desc' => ['Urus Acara manual dan automatik. Gunakan Kalendar untuk merekod Acara secara manual. Log juga Acara secara automatik untuk tujuan penjejakan atau merekod Acara atau Mesyuarat manual. Ini ialah modul utama untuk Pengurusan Hubungan Pelanggan atau Pembekal yang baik.', 'Urus Perkara manual dan automatik. Gunakan Kalendar untuk merekod Perkara secara manual. Log juga Perkara secara automatik untuk tujuan penjejakan atau merekod Perkara atau Mesyuarat manual. Ini ialah modul utama untuk Pengurusan Hubungan Pelanggan atau Pembekal yang baik.'],
        'Module63000Desc' => ['Urus Sumber (pencetak, kereta, bilik, ...) untuk diperuntukkan kepada Acara', 'Urus Sumber (pencetak, kereta, bilik, ...) untuk diperuntukkan kepada Perkara'],
        'Delays_MAIN_DELAY_ACTIONS_TODO' => ['Acara yang dirancang (Acara Agenda) belum siap', 'Perkara yang dirancang (Perkara Agenda) belum siap'],
        'AgendaSetup' => ['Tetapan Modul Acara dan Agenda', 'Tetapan Modul Perkara dan Agenda'],
        'AGENDA_DEFAULT_FILTER_TYPE' => ['Tetapkan jenis Acara ini secara automatik dalam penapis carian paparan Agenda', 'Tetapkan jenis Perkara ini secara automatik dalam penapis carian paparan Agenda'],
        'AGENDA_DEFAULT_FILTER_STATUS' => ['Tetapkan status ini secara automatik untuk Acara dalam penapis carian paparan Agenda', 'Tetapkan status ini secara automatik untuk Perkara dalam penapis carian paparan Agenda'],
        'AGENDA_EVENT_PAST_COLOR' => ['Warna Acara lepas', 'Warna Perkara lepas'],
        'AGENDA_EVENT_CURRENT_COLOR' => ['Warna Acara semasa', 'Warna Perkara semasa'],
        'AGENDA_EVENT_FUTURE_COLOR' => ['Warna Acara akan datang', 'Warna Perkara akan datang'],
        'AGENDA_REMINDER_BROWSER' => ['Benarkan peringatan Acara pada pelayar Pengguna', 'Benarkan peringatan Perkara pada pelayar Pengguna'],
        'AGENDA_REMINDER_EMAIL' => ['Benarkan peringatan Acara melalui e-mel', 'Benarkan peringatan Perkara melalui e-mel'],
        'AGENDA_REMINDER_SMS' => ['Benarkan peringatan Acara melalui SMS', 'Benarkan peringatan Perkara melalui SMS'],
        'AGENDA_REMINDER_Remind' => ['Pilihan/kelewatan peringatan ditakrifkan oleh Pengguna semasa penciptaan Acara.', 'Pilihan/kelewatan peringatan ditakrifkan oleh Pengguna semasa penciptaan Perkara.'],
        'AGENDA_USE_EVENT_TYPE' => ['Gunakan jenis Acara (diurus dalam Menu Tetapan -> Kamus -> Jenis Acara Agenda)', 'Gunakan jenis Perkara (diurus dalam Menu Tetapan -> Kamus -> Jenis Perkara Agenda)'],
        'AGENDA_USE_EVENT_TYPE_DEFAULT' => ['Tetapkan nilai lalai ini secara automatik untuk jenis Acara dalam borang cipta Acara', 'Tetapkan nilai lalai ini secara automatik untuk jenis Perkara dalam borang cipta Perkara'],
        'AGENDA_DEFAULT_REMINDER_EVENT_TYPES' => ['Pratanda peringatan lalai untuk semua Acara daripada salah satu jenis ini', 'Pratanda peringatan lalai untuk semua Perkara daripada salah satu jenis ini'],
        'AGENDA_DEFAULT_REMINDER_EVENT_TYPES_NOTE' => ['Borang pemberitahuan peringatan automatik akan diisi secara lalai semasa penciptaan Acara', 'Borang pemberitahuan peringatan automatik akan diisi secara lalai semasa penciptaan Perkara'],
        'AGENDA_DEFAULT_REMINDER_OFFSET' => ['Tempoh Peringatan lalai sebelum Acara', 'Tempoh Peringatan lalai sebelum Perkara'],
        'PastDelayVCalExport' => ['Jangan eksport Acara lebih lama daripada', 'Jangan eksport Perkara lebih lama daripada'],
        'EmailCollectorHideMailHeadersHelp' => ['Acara Agenda', 'Perkara Agenda'],
        'EmailCollectorExampleToCollectAnswersFromExternalEmailSoftwareDesc' => ['Acara jawapan', 'Perkara jawapan'],
        'EmailCollectorExampleToCollectDolibarrAnswersDesc' => ['Satu Acara (Modul Agenda mesti diaktifkan)', 'Satu Perkara (Modul Agenda mesti diaktifkan)'],
        'RecordEvent' => ['Rekod Acara dalam Agenda', 'Rekod Perkara dalam Agenda'],
        'IfTrackingIDFoundEventWillBeLinked' => ['Acara yang dicipta', 'Perkara yang dicipta'],
        'MailToSendEventPush' => ['E-mel peringatan Acara', 'E-mel peringatan Perkara'],
        'AGENDA_EVENT_DEFAULT_STATUS' => ['Status Acara lalai apabila mencipta Acara daripada borang', 'Status Perkara lalai apabila mencipta Perkara daripada borang'],
        'Permission2401' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission2402' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission2403' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission2411' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission2412' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission2413' => ['acara atau tugasan', 'perkara atau tugasan'],
        'Permission63004' => ['acara agenda', 'perkara agenda'],
        'DictionaryActions' => ['Jenis Acara Agenda', 'Jenis Perkara Agenda'],
        'AgendaExtSitesDesc' => ['acaranya dalam Agenda Dolibarr', 'perkaranya dalam Agenda Dolibarr'],
        'BoxOldestActions' => ['Acara perlu dibuat paling lama', 'Perkara perlu dibuat paling lama'],
        'BoxTitleOldestActionsToDo' => ['%s Acara perlu dibuat paling lama, belum selesai', '%s Perkara perlu dibuat paling lama, belum selesai'],
        'BoxTitleFutureActions' => ['%s Acara akan datang seterusnya', '%s Perkara akan datang seterusnya'],
        'NoUpcomingEvent' => ['Tiada Acara akan datang', 'Tiada Perkara akan datang'],
        'DeleteAction' => ['Hapus acara', 'Hapus perkara'],
        'NewAction' => ['Acara Baru', 'Perkara Baru'],
        'AddAction' => ['Cipta acara', 'Cipta perkara'],
        'AddAnAction' => ['Cipta acara', 'Cipta perkara'],
        'AddActionRendezVous' => ['Cipta acara Janji Temu', 'Cipta perkara Janji Temu'],
        'ConfirmDeleteAction' => ['menghapuskan acara ini', 'menghapuskan perkara ini'],
        'CardAction' => ['Kad Acara', 'Kad Perkara'],
        'ShowAction' => ['Papar acara', 'Papar perkara'],
        'ActionsReport' => ['Laporan acara', 'Laporan perkara'],
        'DoneAndToDoActions' => ['Acara Selesai dan Perlu Buat', 'Perkara Selesai dan Perlu Buat'],
        'DoneActions' => ['Acara Selesai', 'Perkara Selesai'],
        'ToDoActions' => ['Acara Belum Selesai', 'Perkara Belum Selesai'],
        'ActionAC_MANUAL' => ['Acara dimasukkan secara manual', 'Perkara dimasukkan secara manual'],
        'ActionAC_AUTO' => ['Acara dimasukkan secara automatik', 'Perkara dimasukkan secara automatik'],
        'ContactEvents' => ['Acara/Agenda', 'Perkara/Agenda'],
        'ErrorActionCommBadType' => ['Jenis Acara yang dipilih', 'Jenis Perkara yang dipilih'],
        'WarningModuleXDisabledSoYouMayMissEventHere' => ['kehilangan banyak Acara di sini', 'kehilangan banyak Perkara di sini'],
    ],
    'lang/ms_MY/commercial.lang' => [
        'TasksHistoryForThisContact' => ['Acara untuk kenalan ini', 'Perkara untuk kenalan ini'],
        'ActionAffectedTo' => ['Acara ditugaskan kepada', 'Perkara ditugaskan kepada'],
    ],
    'lang/ms_MY/main.lang' => [
        'ContactDefault_agenda' => ['Acara', 'Perkara'],
    ],
    'lang/ms_MY/members.lang' => [
        'ActionsOnMember' => ['Acara berkaitan Anggota ini', 'Perkara berkaitan Anggota ini'],
    ],
    'lang/ms_MY/projects.lang' => [
        'ProjectEvent' => ['Acara Projek', 'Perkara Projek'],
        'CreateEventFromProject' => ['Cipta Acara Daripada Projek', 'Cipta Perkara Daripada Projek'],
        'ListActionsAssociatedProject' => ['Senarai acara yang berkaitan dengan projek', 'Senarai perkara yang berkaitan dengan projek'],
        'ActionsOnProject' => ['Acara pada projek', 'Perkara pada projek'],
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

        [$old, $new] = $entries[$key];
        if (!str_contains($value, $old)) {
            continue;
        }

        $updated = str_replace($old, $new, $value, $count);
        if ($count < 1) {
            continue;
        }

        printf("%s:%d %s: %s -> %s\n", str_replace('/', DIRECTORY_SEPARATOR, $relativePath), $index + 1, $key, $value, $updated);
        $total++;
        $fileCount++;

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

printf("\n%s: %d agenda event correction(s) across %d file(s).\n", $mode === '--apply' ? 'APPLIED' : 'FOUND', $total, $filesChanged);
exit(0);
