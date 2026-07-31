# Dolibarr Malay Translation Sprint 11

## Purpose

Sprint 11 focuses on real UI coverage after the first installation of the Bahasa Melayu Malaysia language pack.

This sprint improves the visible Dolibarr interface areas that still show mixed Bahasa Melayu and English after `ms_MY-v1.0.0`.

## Scope

Sprint 11 focuses on:

- Top bar navigation
- Side menu labels
- Dashboard widgets
- Widget titles
- Widget action links
- Widget empty-state messages
- Chart labels
- Status labels
- Common UI labels that appear across modules

## UI-Driven Translation Direction

Sprint 01 to Sprint 10 were primarily file-driven and release-packaging driven.

Sprint 11 is UI-driven.

The priority is what users actually see after installation.

## Target UI Areas

### 1. Top Bar

Examples to standardise:

- Members → Anggota
- Billing | Payment → Bil | Bayaran
- Accounting → Perakaunan
- Tools → Alat
- Home → Laman Utama

### 2. Side Menu

Examples to standardise:

- My Dashboard → Papan Pemuka Saya
- Admin Tools → Alat Pentadbiran
- Users & Groups → Pengguna & Kumpulan
- Settings / Setup → Tetapan

### 3. Dashboard Widgets

Examples to standardise:

- GLOBAL VIEW → PAPARAN GLOBAL
- late → lewat
- To do → Perlu dibuat
- To accept | refuse → Untuk diterima | ditolak
- To bill → Untuk diinvois
- Unpaid → Belum Dibayar
- Open → Terbuka
- Awaiting reception → Menunggu penerimaan
- To pay → Untuk dibayar
- To validate → Untuk disahkan
- Contributions to receive → Caruman untuk diterima
- Database Statistics → Statistik Pangkalan Data
- Customer Invoices per month → Invois Pelanggan mengikut bulan
- No. of invoices per month → Bil. invois mengikut bulan
- Amount of invoices by month (net of tax) → Jumlah invois mengikut bulan (bersih cukai)
- No customer invoices recorded → Tiada invois pelanggan direkodkan

## Candidate Files

Sprint 11 may enhance the following files:

- `lang/ms_MY/main.lang`
- `lang/ms_MY/admin.lang`
- `lang/ms_MY/users.lang`
- `lang/ms_MY/groups.lang`
- `lang/ms_MY/members.lang`
- `lang/ms_MY/companies.lang`
- `lang/ms_MY/commercial.lang`
- `lang/ms_MY/invoice.lang`
- `lang/ms_MY/orders.lang`
- `lang/ms_MY/bills.lang`
- `lang/ms_MY/banks.lang`
- `lang/ms_MY/accounting.lang`
- `lang/ms_MY/compta.lang`
- `lang/ms_MY/agenda.lang`
- `lang/ms_MY/reports.lang`
- `lang/ms_MY/projects.lang`

## Controlled Terminology Reminder

Use the approved terminology from previous sprints:

- Member → Anggota
- Members → Anggota
- Amount → Jumlah
- Invoice / Bill → Invois
- Supplier Invoice → Invois Pembekal
- Warehouse → Stor
- VAT → SST
- Project → Projek
- Task → Tugasan
- Notification → Pemberitahuan
- Administration → Pentadbiran
- Admin → Pentadbir
- Setup → Tetapan
- Delete → Hapus
- Deleted → Dihapuskan

## Terms To Avoid

Do not use the following as translated values:

- Ahli
- Gudang
- Bil Pembekal
- Yuran Keanggotaan
- Amaun
- Penyelarasan
- Selaraskan
- Diselaraskan
- DiSesuaikan
- Simpan Kira Bergu
- Penyata Untung atau Rugi
- Padam
- Dipadam
- diHapus
- memadam
- dipadam
- Pembuatan
- Arahan Pembuatan
- Titik Jualan
- Jumlah VAT
- Kadar VAT
- Cukai VAT
- Penerima Manfaat
- Persediaan

## Validation

Before opening the pull request, run:

- controlled terminology check
- `.lang` spacing format check
- UI screenshot review
- Git working tree check

## Status

Draft for Dolibarr Malay Translation Sprint 11.
