# Sengiala Language Pack ms_MY — Release Documentation

Dokumen ini menjadi indeks rasmi bagi urutan release Sengiala Language Pack `ms_MY` untuk Dolibarr.

## Tujuan

Folder `docs/releases/` digunakan untuk merekodkan sejarah release, skop perubahan, status validasi, dan hala tuju release seterusnya bagi Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi.

## Release Semasa

| Release | Nama | Status | Catatan |
| --- | --- | --- | --- |
| `ms_MY-v1.0.0` | Initial Stable Release | RELEASED | Asas awal language pack `ms_MY` yang stabil. |
| `ms_MY-v1.0.1` | Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi | RELEASED | Reviewed Batch 1–5000 import, cleanup duplicate key, cleanup istilah terkawal, dan validasi semua fail `.lang`. |

## Urutan Release

Setiap release selepas ini hendaklah mempunyai sekurang-kurangnya dua dokumen rasmi:

1. `RELEASE_NOTES-ms_MY-vX.Y.Z.md`
   - Ringkasan perubahan release.
   - Senarai PR utama.
   - Validasi dan QA ringkas.
   - Nota pemasangan atau naik taraf.

2. `FOUNDATION-RELEASE-ms_MY-vX.Y.Z.md` atau `RELEASE-DECLARATION-ms_MY-vX.Y.Z.md`
   - Kedudukan strategik release.
   - Skop penggunaan.
   - prinsip terminologi.
   - status sebagai milestone language pack.

## Standard Minimum Release

Sebelum sesuatu release ditag, semakan minimum berikut perlu diselesaikan:

```powershell
Get-ChildItem lang\ms_MY\*.lang | ForEach-Object {
  php scripts\validate-lang.php $_.FullName
}
```

Keperluan minimum:

- Semua fail `lang/ms_MY/*.lang` mesti `PASS`.
- Tiada duplicate key.
- Tiada istilah lama yang telah disenarai sebagai istilah terkawal terlarang.
- Working tree mesti bersih.
- Tag release mesti dibuat daripada `main`.

## Cadangan Urutan Seterusnya

| Cadangan Release | Fokus |
| --- | --- |
| `ms_MY-v1.1.0` | Translation Expansion 5001–10000. |
| `ms_MY-v1.2.0` | Translation Expansion 10001–15088. |
| `ms_MY-v2.0.0` | Complete ms_MY Cooperative Edition baseline untuk Dolibarr. |

## Prinsip Release

Release ini bukan sekadar perubahan teknikal `.lang`, tetapi pembinaan asas bahasa aplikasi untuk kegunaan koperasi Malaysia. Setiap release perlu mengekalkan kesinambungan terminologi, kesesuaian paparan sebenar Dolibarr, dan kebolehgunaan operasi harian.