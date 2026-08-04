<?php

declare(strict_types=1);

/**
 * Runtime Correction Batch 7 — Event Domain Terminology.
 *
 * Domain policy:
 * - Dolibarr Agenda semantics: Event/Acara -> Perkara.
 * - Non-Agenda system/business/security semantics: Event/Acara -> Peristiwa.
 * - Event Organization and public organized-event semantics: retain Acara.
 *
 * All changes are key-explicit. No repository-wide blind replacement is used.
 */

$mode = $argv[1] ?? '--check';
if (!in_array($mode, ['--check', '--apply'], true)) {
    fwrite(STDERR, "Usage: php scripts/standardize-agenda-event.php [--check|--apply]\n");
    exit(2);
}

$root = dirname(__DIR__);
$langDir = $root . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . 'ms_MY';

/**
 * Each key contains one or more exact [old, new] replacement pairs.
 * Keys belonging to Event Organization are intentionally absent.
 */
$mapping = [
    // Agenda module -> Perkara
    'Module600Long' => [['Acara Agenda', 'Perkara Agenda']],
    'Module2400Name' => [['Acara/Agenda', 'Perkara/Agenda']],
    'Module2400Desc' => [[
        'Urus Acara manual dan automatik. Gunakan Kalendar untuk merekod Acara secara manual. Log juga Acara secara automatik untuk tujuan penjejakan atau merekod Acara atau Mesyuarat manual. Ini ialah modul utama untuk Pengurusan Hubungan Pelanggan atau Pembekal yang baik.',
        'Urus Perkara manual dan automatik. Gunakan Kalendar untuk merekod Perkara secara manual. Log juga Perkara secara automatik untuk tujuan penjejakan atau merekod Perkara atau Mesyuarat manual. Ini ialah modul utama untuk Pengurusan Hubungan Pelanggan atau Pembekal yang baik.',
    ]],
    'Module63000Desc' => [['diperuntukkan kepada Acara', 'diperuntukkan kepada Perkara']],
    'Delays_MAIN_DELAY_ACTIONS_TODO' => [['Acara yang dirancang (Acara Agenda)', 'Perkara yang dirancang (Perkara Agenda)']],
    'AgendaSetup' => [['Tetapan Modul Acara dan Agenda', 'Tetapan Modul Perkara dan Agenda']],
    'AGENDA_DEFAULT_FILTER_TYPE' => [['jenis Acara', 'jenis Perkara']],
    'AGENDA_DEFAULT_FILTER_STATUS' => [['untuk Acara', 'untuk Perkara']],
    'AGENDA_EVENT_PAST_COLOR' => [['Warna Acara', 'Warna Perkara']],
    'AGENDA_EVENT_CURRENT_COLOR' => [['Warna Acara', 'Warna Perkara']],
    'AGENDA_EVENT_FUTURE_COLOR' => [['Warna Acara', 'Warna Perkara']],
    'AGENDA_REMINDER_BROWSER' => [['peringatan Acara', 'peringatan Perkara']],
    'AGENDA_REMINDER_EMAIL' => [['peringatan Acara', 'peringatan Perkara']],
    'AGENDA_REMINDER_SMS' => [['peringatan Acara', 'peringatan Perkara']],
    'AGENDA_REMINDER_Remind' => [['penciptaan Acara', 'penciptaan Perkara']],
    'AGENDA_USE_EVENT_TYPE' => [
        ['jenis Acara', 'jenis Perkara'],
        ['Jenis Acara Agenda', 'Jenis Perkara Agenda'],
    ],
    'AGENDA_USE_EVENT_TYPE_DEFAULT' => [
        ['jenis Acara', 'jenis Perkara'],
        ['cipta Acara', 'cipta Perkara'],
    ],
    'AGENDA_DEFAULT_REMINDER_EVENT_TYPES' => [['semua Acara', 'semua Perkara']],
    'AGENDA_DEFAULT_REMINDER_EVENT_TYPES_NOTE' => [['penciptaan Acara', 'penciptaan Perkara']],
    'AGENDA_DEFAULT_REMINDER_OFFSET' => [['sebelum Acara', 'sebelum Perkara']],
    'PastDelayVCalExport' => [['eksport Acara', 'eksport Perkara']],
    'EmailCollectorHideMailHeadersHelp' => [['Acara Agenda', 'Perkara Agenda']],
    'EmailCollectorExampleToCollectAnswersFromExternalEmailSoftwareDesc' => [['Acara jawapan', 'Perkara jawapan']],
    'EmailCollectorExampleToCollectDolibarrAnswersDesc' => [['Satu Acara (Modul Agenda mesti diaktifkan)', 'Satu Perkara (Modul Agenda mesti diaktifkan)']],
    'RecordEvent' => [['Rekod Acara dalam Agenda', 'Rekod Perkara dalam Agenda']],
    'IfTrackingIDFoundEventWillBeLinked' => [['Acara yang dicipta', 'Perkara yang dicipta']],
    'MailToSendEventPush' => [['peringatan Acara', 'peringatan Perkara']],
    'AGENDA_EVENT_DEFAULT_STATUS' => [
        ['Status Acara', 'Status Perkara'],
        ['mencipta Acara', 'mencipta Perkara'],
    ],
    'Permission2401' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission2402' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission2403' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission2411' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission2412' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission2413' => [['acara atau tugasan', 'perkara atau tugasan']],
    'Permission63004' => [['acara agenda', 'perkara agenda']],
    'DictionaryActions' => [['Jenis Acara Agenda', 'Jenis Perkara Agenda']],
    'AgendaExtSitesDesc' => [['acaranya dalam Agenda Dolibarr', 'perkaranya dalam Agenda Dolibarr']],
    'BoxOldestActions' => [['Acara perlu dibuat', 'Perkara perlu dibuat']],
    'BoxTitleOldestActionsToDo' => [['Acara perlu dibuat', 'Perkara perlu dibuat']],
    'BoxTitleFutureActions' => [['Acara akan datang', 'Perkara akan datang']],
    'NoUpcomingEvent' => [['Tiada Acara akan datang', 'Tiada Perkara akan datang']],
    'DeleteAction' => [['Hapus acara', 'Hapus perkara']],
    'NewAction' => [['Acara Baru', 'Perkara Baru']],
    'AddAction' => [['Cipta acara', 'Cipta perkara']],
    'AddAnAction' => [['Cipta acara', 'Cipta perkara']],
    'AddActionRendezVous' => [['Cipta acara', 'Cipta perkara']],
    'ConfirmDeleteAction' => [['acara ini', 'perkara ini']],
    'CardAction' => [['Kad Acara', 'Kad Perkara']],
    'ShowAction' => [['Papar acara', 'Papar perkara']],
    'ActionsReport' => [['Laporan acara', 'Laporan perkara']],
    'DoneAndToDoActions' => [['Acara Selesai', 'Perkara Selesai']],
    'DoneActions' => [['Acara Selesai', 'Perkara Selesai']],
    'ToDoActions' => [['Acara Belum Selesai', 'Perkara Belum Selesai']],
    'TasksHistoryForThisContact' => [['Acara untuk kenalan ini', 'Perkara untuk kenalan ini']],
    'ActionAffectedTo' => [['Acara ditugaskan kepada', 'Perkara ditugaskan kepada']],
    'ActionAC_MANUAL' => [['Acara dimasukkan', 'Perkara dimasukkan']],
    'ActionAC_AUTO' => [['Acara dimasukkan', 'Perkara dimasukkan']],
    'ContactEvents' => [['Acara/Agenda', 'Perkara/Agenda']],
    'ErrorActionCommBadType' => [
        ['Jenis Acara yang dipilih', 'Jenis Perkara yang dipilih'],
        ['Jenis Acara', 'Jenis Perkara'],
    ],
    'WarningModuleXDisabledSoYouMayMissEventHere' => [['banyak Acara di sini', 'banyak Perkara di sini']],
    'LatestLinkedEvents' => [['Acara terkini', 'Perkara terkini']],
    'ActionsOnCompany' => [['Acara untuk Pihak Ketiga', 'Perkara untuk Pihak Ketiga']],
    'ActionsOnContact' => [['Acara untuk Kenalan/Alamat', 'Perkara untuk Kenalan/Alamat']],
    'ActionsOnUser' => [['Acara untuk Pengguna', 'Perkara untuk Pengguna']],
    'ActionsOnContract' => [['Acara untuk Kontrak', 'Perkara untuk Kontrak']],
    'ActionsOnMember' => [['Acara berkaitan Anggota', 'Perkara berkaitan Anggota']],
    'ActionsOnProduct' => [['Acara berkaitan Produk', 'Perkara berkaitan Produk']],
    'ActionsOnAsset' => [['Acara untuk Aset Tetap', 'Perkara untuk Aset Tetap']],
    'ContactDefault_agenda' => [['Acara', 'Perkara']],
    'EventReminder' => [['Peringatan Acara', 'Peringatan Perkara']],
    'SendingReminderActionComm' => [['acara agenda', 'perkara agenda']],
    'PageForAgendaTab' => [['tab acara', 'tab perkara']],
    'ActionsOnOrder' => [['Acara berkaitan pesanan', 'Perkara berkaitan pesanan']],
    'PredefinedMailContentSendActionComm' => [['Peringatan acara', 'Peringatan perkara']],
    'ProjectEvent' => [['Acara Projek', 'Perkara Projek']],
    'CreateEventFromProject' => [['Cipta Acara Daripada Projek', 'Cipta Perkara Daripada Projek']],
    'ListActionsAssociatedProject' => [['Senarai acara', 'Senarai perkara']],
    'ActionsOnProject' => [['Acara pada projek', 'Perkara pada projek']],
    'ActionsOnPropal' => [['Acara berkaitan Sebut Harga Pelanggan', 'Perkara berkaitan Sebut Harga Pelanggan']],

    // Non-Agenda event semantics -> Peristiwa
    'ExportAccountingSourceDocHelp' => [['Acara Sumber', 'Peristiwa Sumber']],
    'EventLog' => [['Log Acara', 'Log Peristiwa']],
    'Module600Name' => [['Acara Urusniaga', 'Peristiwa Urus Niaga']],
    'Module600Desc' => [['Acara Urusniaga', 'Peristiwa Urus Niaga']],
    'Module600Long' => [['Acara Urusniaga', 'Peristiwa Urus Niaga']],
    'Module3200Desc' => [
        ['Log Acara Urusniaga', 'Log Peristiwa Urus Niaga'],
        ['Acara diarkibkan', 'Peristiwa diarkibkan'],
        ['bagi Acara berantai', 'bagi Peristiwa berantai'],
    ],
    'AuditedSecurityEvents' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'NoSecurityEventsAreAduited' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'ListOfSecurityEvents' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'SecurityEventsPurged' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'SecurityEvent' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'TrackableSecurityEvents' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'LogEventDesc' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'TriggersDesc' => [['Acara Dolibarr', 'Peristiwa Dolibarr']],
    'NoEventOrNoAuditSetup' => [
        ['Acara keselamatan', 'Peristiwa keselamatan'],
        ['Keselamatan - Acara', 'Keselamatan - Peristiwa'],
    ],
    'NoEventFoundWithCriteria' => [['Acara keselamatan', 'Peristiwa keselamatan']],
    'NotificationsDesc' => [['pada Acara tertentu', 'pada Peristiwa tertentu']],
    'ListOfNotificationsPerUserOrContact' => [['Acara Urusniaga', 'Peristiwa Urus Niaga']],
    'ModuleWebhookDesc' => [['data Acara', 'data Peristiwa']],
    'TriggerCodes' => [['Acara boleh dicetuskan', 'Peristiwa boleh dicetuskan']],
    'TriggerCode' => [['Acara boleh dicetuskan', 'Peristiwa boleh dicetuskan']],
    'ThisIsAnEstimatedValue' => [['acara perniagaan', 'peristiwa perniagaan']],
    'ModuleBuilderDesctriggers' => [['acara perniagaan', 'peristiwa perniagaan']],
    'TriggerDefDesc' => [['acara perniagaan', 'peristiwa perniagaan']],

    // Explicit Event Organization exclusions are intentionally not mapped:
    // MailToSendEventOrganization, EventOrganization*, ModuleEventOrganizationName,
    // OrganizedEvent, ManageOrganizeEvent, EventFee, EventType and related public-event keys.
];

$files = glob($langDir . DIRECTORY_SEPARATOR . '*.lang');
if ($files === false) {
    fwrite(STDERR, "Unable to enumerate language files.\n");
    exit(1);
}

$total = 0;
$filesChanged = 0;

foreach ($files as $path) {
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    if ($lines === false) {
        fwrite(STDERR, "Unable to read: {$path}\n");
        exit(1);
    }

    $fileCount = 0;
    foreach ($lines as $index => $line) {
        if ($line === '' || str_starts_with(ltrim($line), '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        if (!isset($mapping[$key])) {
            continue;
        }

        $updated = $value;
        $lineCount = 0;

        foreach ($mapping[$key] as [$old, $new]) {
            if (!str_contains($updated, $old)) {
                continue;
            }

            $updated = str_replace($old, $new, $updated, $count);
            $lineCount += $count;
        }

        if ($lineCount < 1 || $updated === $value) {
            continue;
        }

        $relativePath = str_replace($root . DIRECTORY_SEPARATOR, '', $path);
        printf(
            "%s:%d %s: %s -> %s\n",
            $relativePath,
            $index + 1,
            $key,
            $value,
            $updated
        );

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
                fwrite(STDERR, "Unable to write: {$path}\n");
                exit(1);
            }
        }
    }
}

printf(
    "\n%s: %d event-domain correction(s) across %d file(s).\n",
    $mode === '--apply' ? 'APPLIED' : 'FOUND',
    $total,
    $filesChanged
);

exit(0);
