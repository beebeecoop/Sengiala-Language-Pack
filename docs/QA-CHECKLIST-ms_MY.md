# Bahasa Melayu Malaysia Language Pack QA Checklist

## Purpose

This checklist defines the quality assurance controls for the Dolibarr Bahasa Melayu Malaysia language pack.

It is used before release packaging to confirm terminology consistency, `.lang` file format compliance, and release readiness.

## 1. Repository Status

- [ ] Active branch is the release or sprint branch.
- [ ] Local branch is up to date with remote.
- [ ] Working tree is clean before PR.
- [ ] All Sprint 01 to Sprint 10 changes are merged or included.

Recommended command:

    git status
    git branch

## 2. Controlled Terminology Check

The following deprecated or rejected terms must not appear as translated values:

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

Recommended command:

    Select-String -Path lang\ms_MY\*.lang -Pattern "Ahli|Gudang|Bil Pembekal|Yuran Keanggotaan|Amaun|Penyelarasan|Selaraskan|Diselaraskan|DiSesuaikan|Simpan Kira Bergu|Penyata Untung atau Rugi|Padam|Dipadam|diHapus|memadam|dipadam|Pembuatan|Arahan Pembuatan|Titik Jualan|Jumlah VAT|Kadar VAT|Cukai VAT|Penerima Manfaat|Persediaan" -CaseSensitive

Expected result:

    No output.

## 3. `.lang` Format Check

All `.lang` entries must use:

    Key=Value

There must be no spaces around `=`.

Recommended command:

    Select-String -Path lang\ms_MY\*.lang -Pattern "^\s*[^#\s][^=]*\s+=|^\s*[^#\s][^=]*=\s+"

Expected result:

    No output.

## 4. Malaysia Tax Standard

For Malaysia, VAT must be translated as SST in values.

Accepted examples:

    VAT=SST
    VATRate=Kadar SST
    VATAmount=Jumlah SST
    TotalVAT=Jumlah SST

Rejected examples:

    VAT=VAT
    VATRate=Kadar VAT
    VATAmount=Jumlah VAT
    TotalVAT=Jumlah VAT

## 5. Core Terminology Confirmation

Approved terminology must be preserved:

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
- Work Order → Arahan Kerja
- POS → POS
- Point of Sale → POS
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

## 6. File Coverage Review

Recommended command:

    Get-ChildItem lang\ms_MY\*.lang | Select-Object Name,Length

Confirm that key sprint files exist and are not empty.

## 7. Release Documentation

Before release, confirm these files exist:

- `docs/RELEASE-NOTES-ms_MY.md`
- `docs/INSTALL-ms_MY.md`
- `docs/QA-CHECKLIST-ms_MY.md`
- `docs/DOLIBARR-MALAY-TRANSLATION-SPRINT-10.md`

## 8. Final Release Gate

Sprint 10 may be marked complete when:

- [ ] Controlled terminology check passes.
- [ ] `.lang` format check passes.
- [ ] Release notes are complete.
- [ ] Installation notes are complete.
- [ ] QA checklist is complete.
- [ ] Working tree is clean.
- [ ] PR has no conflicts.
- [ ] PR is merged into `main`.

## Status

Prepared for release packaging.
