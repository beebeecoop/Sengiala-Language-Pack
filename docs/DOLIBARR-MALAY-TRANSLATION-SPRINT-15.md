# Dolibarr Malay Translation Sprint 15

## Theme

Real Screen Translation Coverage: Core Operations.

Sprint 15 continues the Option B workflow and targets important operational screens captured after Sprint 14 installation.

## Source screens

Sprint 15 is based on visual inspection of real Dolibarr 23.0.3 screens using the Sengiala Language Pack:

- Bank | Tunai / Akaun Bank
- Perakaunan / Accountancy area
- Dokumen / DMS-ECM area
- Agenda
- Alat / Tools
- Bil | Bayaran / Invoicing and payment area

## Merge strategy

Preferred merge method: Rebase and merge.

Reason:

- Each language area remains traceable by commit.
- Hotfixes can target a specific module or screen.
- Real-screen regressions are easier to isolate.

## Key work

### Generic core operation labels

Adds fallback labels for cross-module UI text:

- AccountingArea=Ruang Perakaunan
- AccountingAccount=Akaun Perakaunan
- AccountingCodeJournal=Kod Jurnal Perakaunan
- ShowTutorial=Tunjuk Tutorial
- ManualDirectories=Direktori Manual
- ObjectDirectories=Direktori Objek
- ListView=Paparan Senarai
- MonthView=Paparan Bulan
- AmountIncTax=Jumlah (termasuk cukai)
- NoOpenInvoice=Tiada Invois terbuka

### Accountancy

Adds real screen labels for the accounting landing page and left menu:

- TransferInAccounting=Pindahan ke perakaunan
- CustomerInvoiceBinding=Pautan Invois Pelanggan
- VendorInvoiceBinding=Pautan Invois Pembekal
- RecordingInAccounting=Rekod dalam perakaunan
- ExportSourceDocuments=Eksport dokumen sumber
- ExportAccountancy=Eksport Perakaunan
- Closure=Penutupan
- Reporting=Pelaporan

### DMS / ECM

Adds document screen labels:

- DmsEcmArea=Ruang DMS/ECM
- ManualDirectories=Direktori Manual
- ObjectDirectories=Direktori Objek
- SelectADirectoryInTheTree=Pilih direktori dalam pokok...
- Shared=Dikongsi
- Size=Saiz

### Agenda

Adds calendar screen labels:

- NewEvent=Acara Baru
- MyIncompleteEvents=Acara saya yang belum siap
- MyTerminatedEvents=Acara saya yang telah siap
- AllIncompleteEvents=Semua acara yang belum siap
- BirthdaysOfContacts=Hari lahir kenalan
- PerUserView=Paparan Mengikut Pengguna

### Tools and utilities

Adds utility menu labels:

- EmailTemplates=Templat E-mel
- ImportsExports=Import / Eksport
- NewImport=Import Baru
- NewExport=Eksport Baru
- CustomReports=Laporan Tersuai

### Billing and payment

Adds invoice and payment area labels:

- NewInvoice=Invois Baru
- ListOfTemplates=Senarai Templat
- NumberOfOpenInvoices=Bilangan Invois terbuka
- CustomerDraftInvoices=Draf Invois Pelanggan
- VendorDraftInvoices=Draf Invois Pembekal
- SocialFiscalTaxesToPay=Cukai Fiskal perlu bayar
- AmountIncTax=Jumlah (termasuk cukai)
- ModifDate=Tarikh ubah

### Bank fallback labels

Adds generic fallback labels for the Bank | Tunai screen:

- DepositSlips=Slip Deposit
- AccountingAccount=Akaun Perakaunan
- AccountingCodeJournal=Kod Jurnal Perakaunan
- Opened=Dibuka
- Balance=Baki

## QA notes

- No temporary files were introduced.
- No noop/temp commits were used.
- Changes are grouped into rebase-friendly commits.
- Visual verification after installation is still required because Dolibarr may use module-specific key names for some labels.

## Status

Ready for review and installation test.
