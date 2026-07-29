# SPS-004 — Sengiala Platform Language Standard

## Status

- Artefak: SPS-004
- Versi: 0.1.0
- Bahasa sasaran: Bahasa Melayu Malaysia (`ms_MY`)
- Platform: Dolibarr dan SengialaSuite
- Status: Draf normatif

## 1. Tujuan

Standard ini menetapkan prinsip bahasa, terminologi dan tatacara penterjemahan untuk semua antara muka, dokumentasi dan modul SengialaSuite serta pek bahasa Dolibarr `ms_MY`.

Matlamatnya bukan sekadar menterjemah perkataan, tetapi membentuk **lokalisasi ERP koperasi Malaysia** yang konsisten dengan amalan koperasi, GP23 dan konteks pentadbiran Malaysia.

## 2. Prinsip utama

1. Gunakan Bahasa Melayu Malaysia yang jelas dan profesional.
2. Utamakan istilah koperasi berbanding istilah korporat umum apabila konteksnya koperasi.
3. Kekalkan maksud fungsi asal Dolibarr.
4. Gunakan terjemahan mengikut konteks; satu istilah Inggeris boleh mempunyai lebih daripada satu padanan Melayu.
5. Elakkan terjemahan literal yang mengelirukan pengguna.
6. Kekalkan pemegang tempat, pemboleh ubah, tag HTML dan format teknikal asal.
7. Gunakan istilah yang sama merentas semua fail `.lang`, glosari dan dokumentasi.

## 3. Terminologi normatif teras

| Istilah Inggeris | Istilah Bahasa Melayu | Konteks |
|---|---|---|
| Member | Anggota | Keanggotaan koperasi |
| Membership | Keanggotaan | Modul dan status anggota |
| Share | Modal Syer | Modal anggota |
| Bonus Share | Syer Bonus | Syer yang diterbitkan sebagai bonus |
| Patronage | Potongan Langganan | Pulangan berasaskan urus niaga anggota |
| Bonus | Bonus Langganan | Bonus berkaitan langganan anggota |
| Balance Sheet | Kunci Kira-Kira | Pelaporan kewangan |
| Appropriation | Pembahagian Keuntungan | Pelaporan dan keputusan koperasi |
| Chart of Accounts | Carta Akaun | Perakaunan |
| General Ledger | Lejar Am | Perakaunan |
| Trial Balance | Imbangan Duga | Perakaunan |
| Journal | Jurnal | Perakaunan |
| Financial Year | Tahun Kewangan | Perakaunan |
| Third Party | Pihak Ketiga | Istilah umum Dolibarr |
| Customer | Pelanggan | Jualan |
| Supplier | Pembekal | Pembelian |
| Proposal | Sebut Harga | Komersial |
| Warehouse | Stor | Inventori |
| Supplier Invoice | Bil Pembekal | Pembelian |
| Expense Report | Tuntutan Perbelanjaan | Perbelanjaan |

## 4. Terjemahan mengikut konteks

Istilah `Share` mesti diterjemahkan berdasarkan fungsi:

- modal anggota → **Modal Syer**;
- bonus kepada anggota → **Syer Bonus**;
- tindakan berkongsi fail atau pautan → **Kongsi**.

Terjemahan global tanpa mengambil kira konteks tidak dibenarkan.

## 5. Format fail Dolibarr

Setiap entri menggunakan format:

```text
TranslationKey=Terjemahan Bahasa Melayu
```

Peraturan:

- jangan ubah nama kunci;
- jangan tambah ruang di kiri kunci;
- kekalkan `%s`, `%d`, `{0}`, HTML dan simbol teknikal;
- gunakan UTF-8;
- satu kunci bagi setiap baris;
- komen bermula dengan `#`.

## 6. Hierarki keputusan istilah

Apabila berlaku konflik, gunakan keutamaan berikut:

1. istilah perundangan atau kawal selia Malaysia;
2. istilah rasmi koperasi dan GP23;
3. istilah normatif SPS-004;
4. penggunaan Bahasa Melayu Malaysia yang lazim;
5. transliterasi atau istilah teknikal antarabangsa.

## 7. Kawalan perubahan

Sebarang perubahan kepada istilah normatif mesti:

- direkodkan dalam `CHANGELOG.md`;
- dikemas kini dalam glosari berkaitan;
- dinilai kesannya terhadap semua fail `.lang`;
- melalui pull request dan semakan sebelum digabungkan.

## 8. Skop versi 0.1.0

Versi pertama memberi tumpuan kepada:

- istilah teras Dolibarr;
- Finance Foundation;
- Membership Foundation;
- glosari GP23 dan koperasi;
- rangka fail `main.lang`, `accounts.lang` dan `members.lang`.
