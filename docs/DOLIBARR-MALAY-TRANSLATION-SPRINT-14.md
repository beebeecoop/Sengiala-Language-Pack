# Dolibarr Malay Translation Sprint 14

## Theme

Real Screen Stabilisation after Sprint 13.

Sprint 14 continues the Option B workflow where changes are made directly through the GitHub connector, but with cleaner commit discipline.

## Merge strategy

Preferred merge method: Rebase and merge.

Reason:
- Translation hotfixes are easier to trace by commit.
- Each group of labels remains visible in history.
- Regression review is easier when a key appears in a dedicated commit.

## Focus

Sprint 14 targets remaining labels that may still appear in English after the Sprint 13 real-screen cleanup:

- Generic dashboard and list labels
- Dashboard widget title variants
- Contacts and prospects labels
- Member list/table labels
- Purchase order labels
- Supplier proposal labels
- Commercial proposal labels
- Proposal UI normalisation

## Key additions

### Generic labels

- Stats=Statistik
- CustomerInvoices=Invois Pelanggan
- SupplierInvoices=Invois Pembekal
- VendorInvoices=Invois Pembekal
- PurchaseOrders=Pesanan Belian
- SupplierOrders=Pesanan Pembekal
- VendorProposals=Sebut Harga Pembekal
- NoData=Tiada data
- ToProcess=Perlu Diproses
- ToReceive=Perlu Terima

### Dashboard widgets

- BoxTitleDatabaseStatistics=Statistik Pangkalan Data
- BoxTitleDatabaseStats=Statistik Pangkalan Data
- BoxTitleLastCustomerInvoices=Invois Pelanggan: %s terakhir diubah
- BoxTitleOldestUnpaidCustomerInvoices=Invois Pelanggan: %s belum bayar paling lama
- BoxLastContacts=Kenalan/Alamat Terkini
- BoxLastProspects=Prospek Terkini
- BoxLastCustomerBills=Invois Pelanggan Terkini
- BoxLastSupplierBills=Invois Pembekal Terkini

### Members

- MemberNature=Sifat Anggota
- MemberLogin=Log Masuk Anggota
- MemberSociete=Syarikat
- DateEndSubscription=Tarikh Tamat Keanggotaan
- PaymentSubscription=Bayaran Caruman Baru
- MembersTypeSetup=Tetapan Kelas Anggota

### Commercial and purchasing

- NewPurchaseOrder=Pesanan Belian Baru
- PurchaseOrdersArea=Ruang Pesanan Belian
- PriceRequest=Permintaan Harga
- OpenVendorProposals=Sebut Harga Pembekal Terbuka
- CommercialProposalsArea=Ruang Sebut Harga Komersial
- NewCommercialProposal=Sebut Harga Komersial Baru
- OpenCommercialProposals=Sebut Harga Komersial Terbuka

## QA notes

- No temporary files are introduced.
- No noop/temp commits are used.
- Changes are grouped by meaningful commit messages.
- Visual verification is still required after install because some Dolibarr labels may use module-specific key names.

## Status

Ready for review and installation test.
