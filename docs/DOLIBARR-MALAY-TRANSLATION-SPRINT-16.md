# Dolibarr Malay Translation Sprint 16

## Theme

Real Key Discovery and Capitalisation Polish.

Sprint 16 continues the Option B + Rebase-friendly workflow after Sprint 15 installation testing. It focuses on labels that remained in English or needed controlled UI capitalisation after real-screen review.

## Source basis

Sprint 16 is based on real Dolibarr 23.0.3 screens after Sprint 15 installation:

- Papan Pemuka
- Ruang Anggota
- Perhubungan
- Ruang Urusniaga
- Ruang Bil dan Bayaran
- Bank | Tunai
- Perakaunan
- Dokumen
- Agenda
- Alat

## Controlled terminology decisions

### Koperasi terminology

- Membership payment/subscription context: Caruman
- Contribution: Sumbangan
- Social/fiscal taxes in Malaysia context: Cukai Fiskal

Malaysia usage avoids `Cukai Sosial/Fiskal` because the relevant local context is fiscal tax only.

### UI capitalisation

Module, entity, and UI label nouns are treated as functional proper nouns.

Examples:

- Invois
- Dokumen
- Anggota
- Caruman
- Perakaunan
- Bank
- Agenda
- Sebut Harga
- Pesanan
- Pembekal

## Key refinements

### Agenda

- MyIncompleteEvents=Acara Saya yang Belum Siap
- MyTerminatedEvents=Acara Saya yang Telah Siap
- AllIncompleteEvents=Semua Acara yang Belum Siap
- AllTerminatedEvents=Semua Acara yang Telah Siap
- BirthdaysOfContacts=Hari Lahir Kenalan
- DefaultCalendar=Kalendar Lalai

### Billing and payment

- CustomerDraftInvoices=Draf Invois Pelanggan
- VendorDraftInvoices=Draf Invois Pembekal
- SupplierDraftInvoices=Draf Invois Pembekal
- SocialFiscalTaxesToPay=Cukai Fiskal Perlu Bayar
- SocialFiscalTaxes=Cukai Fiskal
- NoOpenInvoice=Tiada Invois Terbuka
- NumberOfOpenInvoices=Bilangan Invois Terbuka

### Dashboard boxes

- DatabaseStatistics=Statistik Pangkalan Data
- NoRecordedInvoices=Tiada Invois Pelanggan Direkodkan
- NoUnpaidCustomerBills=Tiada Invois Pelanggan Belum Bayar
- NoRecordedContacts=Tiada Kenalan Direkodkan
- VendorInvoices=Invois Pembekal
- VendorProposals=Sebut Harga Pembekal

### Third parties and contacts

- ThirdPartiesContacts=Pihak Ketiga/Kenalan
- NewThirdParty=Pihak Ketiga Baru
- NewProspect=Prospek Baru
- NewCustomer=Pelanggan Baru
- NewVendor=Pembekal Baru
- NewContactAddress=Kenalan/Alamat Baru
- TotalNumberOfThirdParties=Jumlah Bilangan Pihak Ketiga

### Documents

- ManualDirectories=Direktori Manual
- ObjectDirectories=Direktori Objek
- SelectADirectoryInTheTree=Pilih Direktori dalam Pokok...
- Shared=Dikongsi
- Size=Saiz

### Accountancy

- AccountingArea=Ruang Perakaunan
- TransferInAccounting=Pindahan ke Perakaunan
- CustomerInvoiceBinding=Pautan Invois Pelanggan
- VendorInvoiceBinding=Pautan Invois Pembekal
- RecordingInAccounting=Rekod dalam Perakaunan
- ExportSourceDocuments=Eksport Dokumen Sumber

### Commercial and purchasing

- Latest3ModifiedProposals=3 Sebut Harga Terakhir Diubah
- DraftCommercialProposals=Sebut Harga Komersial Draf
- DraftVendorProposals=Sebut Harga Pembekal Draf
- DraftPurchaseOrders=Pesanan Pembekal Draf
- NoProposal=Tiada Sebut Harga
- NoVendorProposal=Tiada Sebut Harga Pembekal
- NoSupplierOrder=Tiada Pesanan Pembekal

## Files changed

- lang/ms_MY/agenda.lang
- lang/ms_MY/bills.lang
- lang/ms_MY/companies.lang
- lang/ms_MY/ecm.lang
- lang/ms_MY/accountancy.lang
- lang/ms_MY/propal.lang
- lang/ms_MY/supplier_proposal.lang
- lang/ms_MY/orders.lang
- lang/ms_MY/boxes.lang
- lang/ms_MY/other.lang
- lang/ms_MY/main.lang

## QA notes

- Sprint 16 uses meaningful, rebase-friendly commits.
- No temporary files are introduced.
- No noop/temp connector commits are used.
- Visual installation testing is required after merge because some remaining English labels may require additional Dolibarr module-specific keys.

## Status

Ready for pull request review and installation test.
