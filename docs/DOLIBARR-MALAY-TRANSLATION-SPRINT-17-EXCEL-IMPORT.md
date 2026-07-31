# Dolibarr Malay Translation Sprint 17

## Theme

Excel Translation Import Pipeline.

Sprint 17 introduces a controlled script to import translation rows from an Excel workbook into `lang/ms_MY/*.lang` files.

This is intended for batch translation work where untranslated Dolibarr keys are exported or collected in Excel first, then reviewed and imported into the Sengiala Language Pack.

## Input workbook format

Default layout:

```text
Column A = Dolibarr language key
Column B = Malay translation value
```

Example:

```ini
Accountancy=Perakaunan
Accounting=Perakaunan
AccountingArea=Ruang Perakaunan
AccountingSystem=Sistem Perakaunan
```

The first trial workbook used for this workflow was `1-250.xlsx`, with one sheet named `Sheet1` and translation rows in `A1:B251`.

## Script

```text
scripts/import-excel-translations.py
```

The script is dependency-free. It reads `.xlsx` files using Python standard library only.

It supports:

- `dry-run` mode before applying changes
- `apply` mode to update `.lang` files
- source key discovery from Dolibarr `en_US` language files
- target key update in existing `lang/ms_MY/*.lang` files
- automatic append into matching module file when the key exists in `en_US`
- fallback file mode for unmapped keys if explicitly enabled
- CSV report generation

## Recommended local folder

```text
inputs/translations/
```

Place trial Excel files there locally. The Excel files do not need to be committed unless intentionally approved.

Example:

```powershell
mkdir inputs\translations -Force
copy C:\Users\<USER>\Downloads\1-250.xlsx inputs\translations\1-250.xlsx
```

## Safe dry-run command

Run this first:

```powershell
cd F:\Sengiala-Language-Pack

python scripts\import-excel-translations.py `
  --excel inputs\translations\1-250.xlsx `
  --target-dir lang\ms_MY `
  --source-dir F:\xampp\htdocs\htdocs\langs\en_US `
  --report-dir reports `
  --mode dry-run
```

Dry-run will not modify `.lang` files. It only reports what would be updated or added.

## Apply command

After reviewing the report:

```powershell
python scripts\import-excel-translations.py `
  --excel inputs\translations\1-250.xlsx `
  --target-dir lang\ms_MY `
  --source-dir F:\xampp\htdocs\htdocs\langs\en_US `
  --report-dir reports `
  --mode apply
```

Then inspect Git changes:

```powershell
git status
git diff -- lang\ms_MY
```

## Report statuses

The generated CSV report may contain:

```text
would_update        Key exists in ms_MY and would be changed
updated             Key exists in ms_MY and was changed
would_add           Key not in ms_MY, found in en_US, would be appended to matching module file
added               Key not in ms_MY, found in en_US, appended to matching module file
skipped_same_value  Existing value already matches Excel value
skipped_unmapped    Key not found in target ms_MY or source en_US
skipped_empty_key   Excel row has no key
skipped_empty_value Excel row has no value
```

## Important rules

1. Always run `dry-run` first.
2. Do not import English values as Malay translations.
3. Prefer module-specific files over dumping everything into `main.lang`.
4. Use `--source-dir` to allow the script to locate the correct Dolibarr module file.
5. Use fallback mode only when manually reviewed.

Fallback example:

```powershell
python scripts\import-excel-translations.py `
  --excel inputs\translations\1-250.xlsx `
  --target-dir lang\ms_MY `
  --source-dir F:\xampp\htdocs\htdocs\langs\en_US `
  --report-dir reports `
  --mode dry-run `
  --allow-unmapped-to-fallback `
  --fallback-file main.lang
```

## QA workflow

After apply:

```powershell
Select-String -Path lang\ms_MY\*.lang -Pattern "^\s*[^#\s][^=]*\s+=|^\s*[^#\s][^=]*=\s+"

Select-String -Path lang\ms_MY\*.lang -Pattern "Ahli|Gudang|Bil Pembekal|Yuran Keanggotaan|Amaun|Penyelarasan|Selaraskan|Diselaraskan|DiSesuaikan|Simpan Kira Bergu|Penyata Untung atau Rugi|Padam|Dipadam|diHapus|memadam|dipadam|Pembuatan|Arahan Pembuatan|Titik Jualan|Jumlah VAT|Kadar VAT|Cukai VAT|Penerima Manfaat|Persediaan" -CaseSensitive
```

Then run local Dolibarr installation test:

```powershell
robocopy lang\ms_MY F:\xampp\htdocs\htdocs\langs\ms_MY *.lang /E /L
robocopy lang\ms_MY F:\xampp\htdocs\htdocs\langs\ms_MY *.lang /E
```

Refresh Dolibarr:

```text
Logout / login semula
Ctrl + F5
```

## Relation to Transifex

This script is for the Sengiala Language Pack repository and practical local use.

The upstream path remains Transifex Dolibarr. Once translations are mature and stable, selected translations can be transferred manually into the official Dolibarr Transifex project.
