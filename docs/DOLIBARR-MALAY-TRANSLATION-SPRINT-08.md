# Dolibarr Malay Translation Sprint 08

## Purpose

Sprint 08 expands the Bahasa Melayu Malaysia language pack for advanced accounting, SST, tax, loans, banking, journals, ledgers, and financial statement terminology.

This sprint builds on Sprint 01 to Sprint 07 terminology decisions and must preserve the approved controlled terminology.

## Scope

Sprint 08 focuses on:

- Tax
- SST
- GST future compatibility
- Loans
- Banking
- Journals
- Ledgers
- Trial balance
- Financial statements
- Advanced accounting terminology

## Target Files

- `lang/ms_MY/tax.lang`
- `lang/ms_MY/vat.lang`
- `lang/ms_MY/loan.lang`
- `lang/ms_MY/compta.lang`

## Possible Enhancement Files

- `lang/ms_MY/accounting.lang`
- `lang/ms_MY/accountancy.lang`
- `lang/ms_MY/banks.lang`
- `lang/ms_MY/paymentbybanktransfer.lang`

## Controlled Terminology Reminder

Use the approved terminology from previous sprints:

- Member → Anggota
- Amount → Jumlah
- Invoice / Bill → Invois
- Supplier Invoice → Invois Pembekal
- Warehouse → Stor
- Stock → Stok
- Inventory → Inventori
- Shipment → Penghantaran
- Delivery → Serahan
- Reception → Penerimaan
- Manufacturing → Pengilangan
- Manufacturing Order / MO → Arahan Pengilangan
- Production → Pengeluaran
- Work Order → Arahan Kerja
- Workstation → Stesen Kerja
- POS → POS
- Point of Sale → POS
- Cash Desk → Kaunter Jualan
- Website → Laman Web
- Online Payment → Bayaran Dalam Talian
- Bank Transfer → Pindahan Bank
- Beneficiary → Benefisiari
- Delete → Hapus
- Deleted → Dihapuskan

## Sprint 08 Terminology Direction

Initial terminology direction:

- Tax → Cukai
- VAT → SST
- SST → SST
- GST → GST
- VAT Rate → Kadar SST
- Tax Rate → Kadar Cukai
- VAT Amount → Jumlah SST
- Tax Amount → Jumlah Cukai
- Total VAT → Jumlah SST
- Sales Tax → Cukai Jualan
- Service Tax → Cukai Perkhidmatan
- Taxable Amount → Jumlah Bercukai
- Tax Exemption → Pengecualian Cukai
- Loan → Pinjaman
- Interest → Faedah
- Bank Account → Akaun Bank
- Journal → Jurnal
- Ledger → Lejar
- General Ledger → Lejar Am
- Trial Balance → Imbangan Duga
- Balance Sheet → Penyata Kedudukan Kewangan
- Income Statement → Penyata Pendapatan
- Cash Flow Statement → Penyata Aliran Tunai

## Important Malaysia Tax Rule

For this Malaysia language pack, VAT must be rendered as SST in translated values.

Accepted examples:

- `VAT=SST`
- `VATRate=Kadar SST`
- `VATAmount=Jumlah SST`
- `TotalVAT=Jumlah SST`

Do not use the following as translated values:

- VAT
- Cukai VAT
- Jumlah VAT
- Kadar VAT

Dolibarr keys may still contain `VAT`; only the translated value must follow the Malaysia SST standard.

## Validation

Before opening the pull request, run terminology and format checks against all `.lang` files.

## Status

Draft for Dolibarr Malay Translation Sprint 08.
