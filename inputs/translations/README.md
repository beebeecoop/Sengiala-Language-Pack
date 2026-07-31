# Translation Input Workbooks

Place Excel workbooks for batch translation import in this folder during local work.

Recommended format:

```text
Column A = Dolibarr language key
Column B = Malay translation value
```

Example:

```ini
Accountancy=Perakaunan
Accounting=Perakaunan
AccountingArea=Ruang Perakaunan
```

Recommended workflow:

```powershell
python scripts\import-excel-translations.py `
  --excel inputs\translations\1-250.xlsx `
  --target-dir lang\ms_MY `
  --source-dir F:\xampp\htdocs\htdocs\langs\en_US `
  --report-dir reports `
  --mode dry-run
```

Do not commit imported Excel files unless the file is intentionally approved as a project artifact.
