# Translation Decision Log

Rekod keputusan terminologi untuk memastikan terjemahan Bahasa Melayu Malaysia kekal konsisten antara modul Dolibarr dan SengialaSuite.

## Status

- Versi: v0.2.0 Finance Foundation
- Skop semasa: `accountancy.lang`, `accounting.lang` dan glosari kewangan

## Keputusan Normatif

### Balance Sheet → Kunci Kira-Kira

**Konteks:** pelaporan kewangan Malaysia.

**Keputusan:** gunakan `Kunci Kira-Kira`, bukan `Lembaran Imbangan`, bagi mengekalkan istilah perakaunan Malaysia yang telah diterima dalam projek.

**Modul terlibat:** Accountancy, Accounting, laporan kewangan.

### Income Statement / Profit and Loss Statement → Penyata Untung atau Rugi

**Konteks:** penyata prestasi kewangan.

**Keputusan:** kedua-dua label sumber dipetakan kepada `Penyata Untung atau Rugi` untuk konsistensi paparan.

**Modul terlibat:** Accountancy, Accounting, laporan kewangan.

### Appropriation → Pembahagian Keuntungan

**Konteks:** pelaporan kewangan koperasi dan GP23.

**Keputusan:** `Appropriation` diterjemahkan sebagai `Pembahagian Keuntungan`; `Appropriation Account` diterjemahkan sebagai `Akaun Pembahagian Keuntungan`.

**Modul terlibat:** Finance Foundation dan pelaporan koperasi.

### Revenue → Hasil; Income → Pendapatan

**Konteks:** klasifikasi akaun dan laporan kewangan.

**Keputusan:** bezakan `Revenue` sebagai `Hasil` dan `Income` sebagai `Pendapatan` untuk mengelakkan pertindihan konsep.

**Modul terlibat:** Accountancy dan Accounting.

### Posting → Pengeposan

**Konteks:** proses memindahkan catatan ke lejar.

**Keputusan:** gunakan kata nama `Pengeposan`; tindakan `Post Accounting Entry` diterjemahkan sebagai `Pos Catatan Perakaunan`.

**Modul terlibat:** Accounting dan Bookkeeping.

### Reconciliation → Penyesuaian

**Konteks:** penyelarasan rekod perakaunan dengan rekod bank atau rekod sokongan.

**Keputusan:** gunakan `Penyesuaian`; `Bank Reconciliation` menjadi `Penyesuaian Bank`.

**Modul terlibat:** Accounting, Banks dan Cash.

## Prinsip Pelaksanaan

1. Terjemahan dibuat mengikut konteks, bukan secara literal.
2. Satu konsep menggunakan satu istilah normatif merentas modul.
3. Istilah GP23 dan koperasi mengatasi istilah korporat generik apabila konteksnya khusus kepada koperasi.
4. Kekunci Dolibarr dikekalkan; hanya nilai terjemahan diubah.
5. Keputusan baharu hendaklah direkodkan bersama konteks, rasional dan modul terlibat.
