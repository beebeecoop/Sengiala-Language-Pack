# Terminology Style Guide

Panduan ini menetapkan gaya bahasa bagi antaramuka, fail bahasa, dokumentasi dan laporan Sengiala-Language-Pack serta SengialaSuite.

## TSR-001 — Kata Nama Rasmi

Kata Nama Rasmi sistem menggunakan Huruf Besar pada awal setiap perkataan.

Contoh:

- Lejar Am
- Buku Tunai
- Akaun Bank
- Akaun Tunai
- Imbangan Duga
- Kunci Kira-Kira
- Penyata Kewangan
- Modal Syer

Konvensyen ini digunakan bagi nama modul, fungsi, laporan, entiti, dokumen dan konsep sistem yang telah ditetapkan sebagai istilah rasmi.

## TSR-002 — Pernyataan dan Ayat

Pernyataan dan ayat menggunakan struktur ayat Bahasa Melayu biasa. Kata Nama Rasmi yang hadir dalam ayat mengekalkan konvensyen TSR-001.

Contoh:

- Sila buka **Lejar Am** untuk menyemak transaksi.
- Sistem akan menjana **Kunci Kira-Kira** pada akhir tempoh kewangan.
- Rekod dalam **Buku Tunai** telah berjaya dikemas kini.
- Pilih **Akaun Bank** yang hendak diselaraskan.

## TSR-003 — Penggunaan Umum

Istilah yang digunakan sebagai keterangan umum dan bukan nama rasmi boleh mengikuti penggunaan huruf biasa menurut tatabahasa Bahasa Melayu.

Contoh:

- Nama rasmi sistem: **Buku Tunai**
- Penggunaan umum: buku tunai organisasi

Apabila terdapat keraguan dalam antaramuka atau dokumentasi produk, utamakan bentuk Kata Nama Rasmi.

## TSR-004 — Terjemahan Mengikut Konteks

Terjemahan tidak dibuat perkataan demi perkataan tanpa mengambil kira domain.

Contoh:

| Sumber | Konteks | Istilah Rasmi |
|---|---|---|
| Share | Modal anggota | Modal Syer |
| Share | Terbitan bonus | Syer Bonus |
| Reconciliation | Perbankan | Penyelarasan |
| Appropriation | Pelaporan koperasi | Pembahagian Keuntungan |

## TSR-005 — Konsistensi

Satu konsep hendaklah menggunakan satu istilah normatif merentas:

- antaramuka pengguna;
- laporan;
- dokumentasi;
- manual pengguna;
- bahan latihan;
- glosari;
- kod dan fail bahasa.

## TSR-006 — Singkatan

Jangan cipta singkatan baharu tanpa keperluan yang jelas. Kekalkan singkatan teknikal atau antarabangsa yang telah mantap seperti IBAN, BIC, SWIFT dan SEPA.

## TSR-007 — Tindakan dan Status

Gunakan bentuk kata kerja bagi tindakan dan bentuk keadaan bagi status.

| Jenis | English | Bahasa Melayu |
|---|---|---|
| Tindakan | Reconcile | Selaraskan |
| Status | Reconciled | Telah Diselaraskan |
| Status | Unreconciled | Belum Diselaraskan |
| Tindakan | Delete Account | Padam Akaun |

## TSR-008 — Struktur Teknikal

Kekunci asal Dolibarr tidak boleh diterjemahkan atau diubah. Hanya nilai selepas tanda `=` diterjemahkan. Pemegang tempat seperti `%s`, tag HTML dan aksara kawalan hendaklah dikekalkan.
