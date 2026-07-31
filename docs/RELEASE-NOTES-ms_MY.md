# Release Notes — Bahasa Melayu Malaysia Language Pack

## Release Purpose

This release provides a Bahasa Melayu Malaysia language pack for Dolibarr ERP/CRM.

The language pack is prepared with Malaysian terminology, cooperative-friendly wording, and controlled translation standards developed across Sprint 01 to Sprint 10.

## Language

- Language code: `ms_MY`
- Language name: Bahasa Melayu Malaysia
- Target platform: Dolibarr ERP/CRM

## Release Scope

This release covers core Dolibarr language areas including:

- Core business terminology
- Commercial workflow
- Users, groups, permissions, and security
- HR and leave
- Documents, files, reports, and PDF
- Stock, warehouse, shipment, delivery, and reception
- Manufacturing, BOM, work orders, and workstation
- POS, cash desk, website, e-commerce, and online payment
- Tax, SST, accounting, banking, and loans
- Projects, agenda, notification, administration, system, and module builder

## Completed Translation Sprints

- Sprint 01 — Foundation Terminology & Core Business
- Sprint 02 — Commercial Workflow
- Sprint 03 — Users, Security, Permissions, HR & Leave
- Sprint 04 — Documents, Files, Reports & PDF
- Sprint 05 — Stock, Warehouse, Shipment & Logistics
- Sprint 06 — Manufacturing, BOM & Work Orders
- Sprint 07 — POS, Website, E-commerce & Public Interface
- Sprint 08 — Advanced Accounting, SST, Tax & Banking
- Sprint 09 — Project, Agenda, Notification & System Administration Enhancement
- Sprint 10 — Final Coverage, QA & Release Packaging

## Key Terminology Decisions

The release uses the following controlled terminology:

- Member → Anggota
- Membership → Keanggotaan
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
- Work Order → Arahan Kerja
- POS → POS
- Point of Sale → POS
- Cash Desk → Kaunter Jualan
- Website → Laman Web
- Online Payment → Bayaran Dalam Talian
- Bank Transfer → Pindahan Bank
- Beneficiary → Benefisiari
- Tax → Cukai
- VAT → SST
- SST → SST
- GST → GST
- Loan → Pinjaman
- Journal → Jurnal
- Ledger → Lejar
- Project → Projek
- Task → Tugasan
- Notification → Pemberitahuan
- Alert → Amaran
- Reminder → Peringatan
- Administration → Pentadbiran
- Admin → Pentadbir
- System → Sistem
- Module Builder → Pembina Modul
- Delete → Hapus
- Deleted → Dihapuskan

## Malaysia Tax Standard

For Malaysia, VAT keys in Dolibarr are translated as SST in display values.

Accepted examples:

    VAT=SST
    VATRate=Kadar SST
    VATAmount=Jumlah SST
    TotalVAT=Jumlah SST

## Quality Assurance

The release is subject to the following QA checks:

- Controlled terminology check
- `.lang` spacing format check
- File coverage review
- Installation notes review
- Release notes review
- Clean Git working tree before PR

QA checklist:

    docs/QA-CHECKLIST-ms_MY.md

Installation notes:

    docs/INSTALL-ms_MY.md

## Release Status

Prepared for release packaging.
