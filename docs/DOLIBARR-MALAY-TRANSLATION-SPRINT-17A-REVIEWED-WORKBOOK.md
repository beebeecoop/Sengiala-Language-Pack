# Dolibarr Malay Translation Sprint 17A — Reviewed Workbook Workflow

## Purpose

Sprint 17A changes the Excel workflow from direct import to reviewed import.

The original Excel file may contain English/source text. Therefore, it must not be applied directly into `lang/ms_MY`.

The correct workflow is:

1. Use the current `lang/ms_MY` files as the trusted Malay baseline.
2. Use the input Excel workbook as a key/source list.
3. Use Dolibarr `en_US` language files to discover the correct module file for missing keys.
4. Generate a reviewed workbook.
5. Translate only rows that need translation.
6. Set reviewed rows to `Status=ready`.
7. Import only reviewed rows.

## Scripts

### 1. Prepare reviewed workbook

```powershell
python scripts\prepare-excel-translation-workbook.py `
  --excel inputs\translations\1-250.xlsx `
  --target-dir lang\ms_MY `
  --source-dir F:\xampp\htdocs\htdocs\langs\en_US `
  --output reports\translation-workbook-1-250-reviewed.xlsx
```

Output workbook columns:

| Column | Name | Meaning |
| --- | --- | --- |
| A | Key | Dolibarr language key |
| B | SourceEnglish | English/source text from input Excel |
| C | CurrentMalay | Current translation from `lang/ms_MY`, if any |
| D | ProposedMalay | Translation to review or add |
| E | TargetFile | Target `.lang` file |
| F | Action | `no_change`, `add`, or `skip` |
| G | Status | `existing`, `needs_translation`, `ready`, or other status |
| H | Note | Review note |

### 2. Review workbook manually

For rows with:

```text
Action=add
Status=needs_translation
```

Translate column `D` (`ProposedMalay`) and change column `G` (`Status`) to:

```text
ready
```

Existing translations should stay as:

```text
Action=no_change
Status=existing
```

This preserves mature translations created during Sprint 1–16.

## Import reviewed rows

Dry-run first:

```powershell
python scripts\import-reviewed-excel-translations.py `
  --excel reports\translation-workbook-1-250-reviewed.xlsx `
  --target-dir lang\ms_MY `
  --report-dir reports `
  --mode dry-run
```

Apply only after the dry-run report is correct:

```powershell
python scripts\import-reviewed-excel-translations.py `
  --excel reports\translation-workbook-1-250-reviewed.xlsx `
  --target-dir lang\ms_MY `
  --report-dir reports `
  --mode apply
```

## Safety rules

The reviewed importer is deliberately conservative:

- It imports only `Status=ready` rows.
- It skips blank `ProposedMalay` values.
- It does not overwrite existing `lang/ms_MY` keys by default.
- It generates a CSV report for every run.

To intentionally update an existing key, the row should use:

```text
Action=update_reviewed
Status=ready
```

and the command must include:

```powershell
--allow-update-existing
```

This keeps existing Malay translations protected unless the reviewer explicitly decides otherwise.

## Translation order rule

Use natural Malay noun order for draft document labels:

```ini
InvoiceDraft=Draf Invois
CustomerInvoiceDraft=Draf Invois Pelanggan
SupplierInvoiceDraft=Draf Invois Pembekal
PurchaseOrderDraft=Draf Pesanan Belian
SupplierOrderDraft=Draf Pesanan Pembekal
VendorProposalDraft=Draf Sebut Harga Pembekal
```

Avoid:

```ini
InvoiceDraft=Invois Draf
PurchaseOrderDraft=Pesanan Belian Draf
ProposalDraft=Sebut Harga Draf
```

## Upstream note

This local workflow supports practical completion of the Sengiala Language Pack. Mature translations can later be contributed through the official Dolibarr Transifex workflow.
