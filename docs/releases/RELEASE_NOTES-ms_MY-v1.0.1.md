# Release Notes — Sengiala Language Pack ms_MY v1.0.1

## Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi

Release `ms_MY-v1.0.1` ialah release rasmi selepas `ms_MY-v1.0.0` dan menandakan selesainya fasa import reviewed Batch 1–5000 bersama cleanup akhir validasi.

## Ringkasan

| Perkara | Nilai |
| --- | --- |
| Release | `ms_MY-v1.0.1` |
| Nama | Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi |
| Platform sasaran | Dolibarr 23.0.3 |
| Base commit | `06bf90f` |
| Status | RELEASED |
| Skop utama | Reviewed Batch 1–5000 import + final validation cleanup |
| Validasi | Semua fail `lang/ms_MY/*.lang` PASS |

## Sorotan Utama

Release ini menyelesaikan lebih 5,000 istilah awal Dolibarr daripada keseluruhan 15,088 istilah yang dikenal pasti.

Pencapaian utama:

- penyempurnaan Batch 1–5000 reviewed translation import;
- penyempurnaan `accountancy.lang` Batch 1 dan Batch 2A;
- penyempurnaan `bills.lang` Batch 2B;
- penyempurnaan `agenda.lang` Batch 2C;
- penyempurnaan `admin.lang` Batch 2D Part 1 hingga Part 5;
- cleanup duplicate key merentas fail `.lang` sedia ada;
- cleanup istilah lama yang tidak lagi selaras dengan terminologi terkawal;
- release tag `ms_MY-v1.0.1` dicipta daripada commit validated.

## PR Utama

| PR | Ringkasan |
| --- | --- |
| PR #32 | Import reviewed accountancy translations Batch 1. |
| PR #33 | Import reviewed accountancy translations Batch 2A. |
| PR #34 | Import reviewed bills translations Batch 2B. |
| PR #35 | Import reviewed agenda translations Batch 2C. |
| PR #36 | Import reviewed admin translations Batch 2D Part 1. |
| PR #37 | Import reviewed admin translations Batch 2D Part 2. |
| PR #38 | Import reviewed admin translations Batch 2D Part 3. |
| PR #39 | Import reviewed admin translations Batch 2D Part 4. |
| PR #40 | Complete reviewed admin translations Batch 2D Part 5. |
| PR #41 | Remove duplicate keys and final terminology issues. |

## Modul Teras Diliputi

Release ini memberi liputan penting kepada modul dan ruang operasi berikut:

- Pentadbiran;
- Perakaunan;
- Invois Pelanggan;
- Invois Pembekal;
- Bank dan Tunai;
- Agenda;
- Dokumen;
- Perhubungan;
- Keanggotaan;
- Tetapan sistem;
- Kebenaran dan pengguna;
- Import dan eksport;
- Paparan dashboard dan statistik.

## Validasi

Validasi akhir dijalankan terhadap semua fail `lang/ms_MY/*.lang` menggunakan:

```powershell
Get-ChildItem lang\ms_MY\*.lang | ForEach-Object {
  php scripts\validate-lang.php $_.FullName
}
```

Status akhir:

```text
All lang/ms_MY/*.lang: PASS
Duplicate key cleanup: PASS
Controlled terminology scan: PASS
Working tree: clean
```

## Cleanup Akhir

Cleanup akhir membuang duplicate key dan menyelesaikan beberapa isu istilah lama.

Antara prinsip cleanup:

- kekalkan entri pertama apabila duplicate key dikesan;
- buang entri duplicate kemudian;
- betulkan istilah lama kepada istilah terkawal;
- pastikan semua fail `.lang` masih valid selepas cleanup.

## Nota Pemasangan

Untuk memasang release ini ke Dolibarr tempatan:

```powershell
robocopy lang\ms_MY F:\xampp\htdocs\htdocs\langs\ms_MY *.lang /E
```

Selepas pemasangan:

```text
Logout / login semula Dolibarr
Hard refresh browser: Ctrl + F5
```

## Nota QA Paparan Sebenar

Release ini telah diuji melalui paparan sebenar Dolibarr 23.0.3, termasuk:

- laporan prestasi;
- statistik Invois Pembekal;
- Akaun Kewangan Baru;
- rekod dalam Perakaunan;
- Agenda bulanan.

QA paparan sebenar menunjukkan language pack boleh digunakan dalam UI sebenar, walaupun sebahagian kecil istilah teknikal Dolibarr masih akan disambung dalam release seterusnya.

## Urutan Selepas v1.0.1

Release ini menjadi asas kepada urutan berikut:

| Cadangan Release | Fokus |
| --- | --- |
| `ms_MY-v1.1.0` | Translation Expansion 5001–10000. |
| `ms_MY-v1.2.0` | Translation Expansion 10001–15088. |
| `ms_MY-v2.0.0` | Complete Cooperative Edition baseline. |

## Penutup

`ms_MY-v1.0.1` menutup fasa foundation awal dengan status validated, cleaned dan released.

Ia menjadi milestone rasmi pertama yang menghubungkan kerja translation import, QA paparan sebenar, validasi teknikal dan orientasi koperasi dalam satu release yang berurutan.