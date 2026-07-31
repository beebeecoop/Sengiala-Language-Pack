# Dolibarr Malay Translation Sprint 13

## Theme

Real Screen Cleanup using Option B — Direct GitHub PR.

Sprint 13 is the first trial where changes are made directly through the GitHub connector instead of local PowerShell patch commands.

## Source basis

The cleanup is based on screenshots after installing Sprint 12 into Dolibarr 23.0.3 using the md theme.

## Focus

- Remaining English labels on Members screen
- Remaining English labels on Dashboard widgets
- Remaining English labels on Commercial / Urusniaga screen
- Proposal, vendor proposal, and purchase order labels
- Generic UI labels still visible in English

## Key updates

### Generic UI

- New=Baru
- Statistics=Statistik
- FirstName=Nama Pertama
- LastName=Nama Akhir
- Societe=Syarikat
- NatureOfMember=Sifat Anggota
- EndDate=Tarikh Tamat
- Statut=Status
- ToClose=Perlu Tutup
- NoContactsRecorded=Tiada kenalan direkodkan
- NotEnoughData=Data tidak mencukupi

### Members

- MemberStatusActiveLate=Caruman Tamat
- MemberStatusActiveLateShort=Tamat
- MembersWithSubscriptionToReceiveShort=Caruman Belum Terima

### Dashboard boxes

- BoxTitleLastCustomerBills=Invois Pelanggan: %s terakhir diubah
- BoxTitleOldestUnpaidCustomerBills=Invois Pelanggan: %s tertunggak paling lama
- NoRecordedContacts=Tiada kenalan direkodkan
- OpenCommercialProposals=Sebut Harga Komersial Terbuka
- DraftCommercialProposals=Sebut Harga Komersial Draf
- DraftVendorProposals=Sebut Harga Pembekal Draf
- DraftPurchaseOrders=Pesanan Pembekal Draf

### Commercial / proposals

- Added propal.lang for Dolibarr real proposal keys
- NewPropal=Sebut Harga Baru
- DraftCommercialProposals=Sebut Harga Komersial Draf
- OpenCommercialProposals=Sebut Harga Komersial Terbuka
- NoPropal=Tiada sebut harga

### Purchase orders

- SuppliersOrders=Pesanan Pembekal
- SuppliersOrdersArea=Ruang Pesanan Pembekal
- SuppliersOrdersAwaitingReception=Pesanan Pembekal Menunggu Penerimaan
- DraftPurchaseOrders=Pesanan Pembekal Draf

### Vendor proposals

- VendorProposal=Sebut Harga Pembekal
- VendorProposals=Sebut Harga Pembekal
- NewPriceRequest=Permintaan Harga Baru
- DraftVendorProposals=Sebut Harga Pembekal Draf

## QA

- Files were edited directly through GitHub connector.
- PR should be reviewed visually after install because some Dolibarr screens may use module-specific or hard-coded labels.

## Status

Ready for pull request review.
