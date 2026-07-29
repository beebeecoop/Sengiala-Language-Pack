# Translation Decision Log

Rekod keputusan terminologi untuk memastikan terjemahan Bahasa Melayu Malaysia kekal konsisten antara modul Dolibarr dan SengialaSuite.

## Status

- Versi: v0.2.0 Finance Foundation
- Skop semasa: `accountancy.lang`, `accounting.lang`, `banks.lang`, `cash.lang` dan glosari kewangan

## Keputusan Normatif

### FIN-0001 — Balance Sheet → Kunci Kira-Kira

**Konteks:** pelaporan kewangan Malaysia.

**Keputusan:** gunakan `Kunci Kira-Kira`, bukan `Lembaran Imbangan`, bagi mengekalkan istilah perakaunan Malaysia yang telah diterima dalam projek.

**Status:** Digunakan.

### FIN-0002 — Appropriation → Pembahagian Keuntungan

**Konteks:** pelaporan kewangan koperasi dan GP23.

**Keputusan:** `Appropriation` diterjemahkan sebagai `Pembahagian Keuntungan`; `Appropriation Account` diterjemahkan sebagai `Akaun Pembahagian Keuntungan`.

**Status:** Digunakan.

### FIN-0003 — Bank Reconciliation → Penyelarasan Bank

**Konteks:** proses menyelaraskan rekod sistem dengan Penyata Bank.

**Keputusan:** gunakan `Penyelarasan`, bukan `Penyesuaian`. Oleh itu, `Bank Reconciliation` diterjemahkan sebagai `Penyelarasan Bank`, `Reconcile` sebagai `Selaraskan`, `Reconciled` sebagai `Telah Diselaraskan`, dan `Unreconciled` sebagai `Belum Diselaraskan`.

**Rasional:** istilah ini lebih jelas dalam amalan kewangan Malaysia dan menerangkan tindakan menyelaraskan dua set rekod.

**Status:** Digunakan. Istilah lama `Penyesuaian Bank` dilupuskan.

### FIN-0004 — Income Statement / Profit and Loss Statement → Penyata Untung atau Rugi

**Konteks:** penyata prestasi kewangan.

**Keputusan:** kedua-dua label sumber dipetakan kepada `Penyata Untung atau Rugi` untuk konsistensi paparan.

**Status:** Digunakan.

### FIN-0005 — Revenue → Hasil; Income → Pendapatan

**Konteks:** klasifikasi akaun dan laporan kewangan.

**Keputusan:** bezakan `Revenue` sebagai `Hasil` dan `Income` sebagai `Pendapatan` untuk mengelakkan pertindihan konsep.

**Status:** Digunakan.

### FIN-0006 — Posting → Pengeposan

**Konteks:** proses memindahkan catatan ke lejar.

**Keputusan:** gunakan kata nama `Pengeposan`; tindakan `Post Accounting Entry` diterjemahkan sebagai `Pos Catatan Perakaunan`.

**Status:** Digunakan.

## Status Kitar Hayat Terminologi

| Status | Maksud |
|---|---|
| Draf | Istilah sedang dicadangkan atau dibincangkan. |
| Diluluskan | Istilah telah dipersetujui sebagai standard projek. |
| Digunakan | Istilah telah dilaksanakan dalam fail bahasa, dokumentasi atau kod. |
| Disemak | Istilah telah melalui semakan semula. |
| Dilupuskan | Istilah tidak lagi aktif tetapi rekod sejarahnya dikekalkan. |

## Prinsip Pelaksanaan

1. Terjemahan dibuat mengikut konteks, bukan secara literal.
2. Satu konsep menggunakan satu istilah normatif merentas modul.
3. Istilah GP23 dan koperasi mengatasi istilah korporat generik apabila konteksnya khusus kepada koperasi.
4. Kekunci Dolibarr dikekalkan; hanya nilai terjemahan diubah.
5. Keputusan baharu hendaklah direkodkan bersama konteks, rasional dan modul terlibat.
6. Kata Nama Rasmi sistem menggunakan Huruf Besar pada setiap perkataan, seperti `Lejar Am`, `Buku Tunai` dan `Akaun Bank`.
7. Pernyataan dan ayat menggunakan struktur ayat Bahasa Melayu biasa, manakala Kata Nama Rasmi mengekalkan konvensyen tersebut.
