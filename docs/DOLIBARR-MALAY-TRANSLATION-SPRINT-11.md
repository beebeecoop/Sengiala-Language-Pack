# Dolibarr Malay Translation Sprint 11

## Purpose

Sprint 11 focuses on real UI coverage after the first installation of the Bahasa Melayu Malaysia language pack.

This sprint improves the visible Dolibarr interface areas that still show mixed Bahasa Melayu and English after `ms_MY-v1.0.0`.

## Scope

Sprint 11 focuses on:

- Top bar navigation
- Side menu labels for all major modules
- Dashboard widgets
- Widget titles
- Widget action links
- Widget empty-state messages
- Chart labels
- Status labels
- DMS / EDM / Documents interface
- Common UI labels that appear across modules

## UI-Driven Translation Direction

Sprint 01 to Sprint 10 were primarily file-driven and release-packaging driven.

Sprint 11 is UI-driven.

The priority is what users actually see after installation.

## Target UI Areas

### 1. Top Bar

Approved UI direction:

- Home → Laman Utama
- Members → Anggota
- Third Parties → Perhubungan
- Commercial → Urusniaga
- Billing | Payment → Bil | Bayaran
- Bank | Cash → Bank | Tunai
- Accounting → Perakaunan
- Agenda → Agenda
- Documents / DMS / EDM → Dokumen
- Tools → Alat
- SengialaSuite → SengialaSuite

### 2. Side Menu

Examples to standardise:

- My Dashboard → Papan Pemuka Saya
- Admin Tools → Alat Pentadbiran
- Users & Groups → Pengguna & Kumpulan
- Settings / Setup → Tetapan
- Documents → Dokumen
- Files → Fail
- Attachments → Lampiran
- Folders → Folder

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

## UI Navigation Terminology Decision

Sprint 11 introduces a UI navigation distinction between visible menu labels and technical entity labels.

Approved decisions:

- Third Parties → Perhubungan
- Third Party → Pihak Ketiga
- Commercial → Urusniaga
- Documents / DMS / EDM → Dokumen
- Document Management → Pengurusan Dokumen
- ECM → Pengurusan Kandungan

Explanation:

- `Perhubungan` is preferred for top bar and user-facing navigation.
- `Pihak Ketiga` remains valid for technical entity records and forms.
- `Urusniaga` is preferred over `Komersial` for business workflow navigation.
- `Dokumen` is preferred for visible DMS / EDM / Documents module navigation.

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
- `lang/ms_MY/documents.lang`
- `lang/ms_MY/files.lang`
- `lang/ms_MY/ecm.lang`

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

## Completion Note

Sprint 11 completed UI-driven Bahasa Melayu Malaysia coverage for Dolibarr 23.0.3.

Coverage completed:
- Top bar navigation
- Side menu terminology
- Dashboard widgets
- Relationship / Perhubungan navigation
- Commercial / Urusniaga navigation
- Billing and payment widgets
- Bank and cash widgets
- Accounting UI coverage
- Documents, DMS, EDM and ECM coverage
- Files and attachment UI coverage
- Membership / Keanggotaan UI coverage
- Administration, users, groups and permissions coverage
- Reports and dashboard widgets
- Agenda, tasks and project UI coverage

Controlled terminology retained:
- ThirdParties=Perhubungan for UI navigation
- ThirdParty=Pihak Ketiga for entity context
- Commercial=Urusniaga
- Member=Anggota
- Membership=Keanggotaan
- Subscription=Caruman Anggota
- ShareCapital=Modal Syer
- DMS=Dokumen
- EDM=Dokumen
- ECM=Pengurusan Kandungan
- BalanceSheet=Kunci Kira-Kira

QA checks:
- Language file spacing format checked
- Controlled terminology scan checked
- Working tree clean before pull request preparation
