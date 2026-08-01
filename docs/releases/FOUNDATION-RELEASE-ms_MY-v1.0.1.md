# Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi

## Sengiala Language Pack ms_MY v1.0.1

`ms_MY-v1.0.1` ditetapkan sebagai **Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi**.

Release ini menjadi asas rasmi bagi usaha membina terjemahan Bahasa Melayu Malaysia yang sesuai untuk penggunaan Dolibarr dalam konteks koperasi, perakaunan, keanggotaan, pentadbiran dan operasi harian.

## Identiti Release

| Perkara | Nilai |
| --- | --- |
| Nama release | Sengiala Language Pack ms_MY v1.0.1 |
| Nama milestone | Foundation Release Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi |
| Tag | `ms_MY-v1.0.1` |
| Base commit | `06bf90f` |
| Platform sasaran | Dolibarr 23.0.3 |
| Bahasa | Bahasa Melayu Malaysia (`ms_MY`) |
| Orientasi | Koperasi |
| Status | RELEASED |

## Deklarasi Release

Sengiala Language Pack `ms_MY v1.0.1` menandakan satu pencapaian asas dalam pembinaan Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi.

Release ini menyediakan asas terjemahan terkawal untuk modul dan paparan penting Dolibarr, termasuk pentadbiran, perakaunan, bank, tunai, invois, agenda, dokumen, perhubungan, keanggotaan dan operasi harian.

Ia dibina bukan semata-mata sebagai terjemahan literal, tetapi sebagai language pack operasi yang mengambil kira penggunaan sebenar dalam persekitaran koperasi Malaysia.

## Skop Foundation Release

Skop release ini merangkumi:

- import terjemahan reviewed daripada workbook Batch 1–5000;
- penyempurnaan modul utama seperti `accountancy`, `bills`, `agenda` dan `admin`;
- pembersihan duplicate key dalam fail `.lang` sedia ada;
- pembersihan istilah lama yang tidak selaras dengan terminologi terkawal;
- validasi penuh semua fail `lang/ms_MY/*.lang`;
- ujian paparan sebenar pada Dolibarr 23.0.3;
- penetapan milestone sebagai asas release seterusnya.

## Kedudukan Koperasi

Release ini menggunakan orientasi koperasi sebagai asas bahasa aplikasi.

Istilah seperti `Anggota`, `Keanggotaan`, `Caruman`, `Modal Syer`, `Invois Pembekal`, `Perhubungan`, `Urusniaga`, `Perakaunan`, `Bank`, `Tunai`, `Agenda`, `Dokumen`, `Pentadbiran`, `Kebenaran`, dan `Hak Akses` menjadi sebahagian daripada identiti bahasa yang dikawal.

Dengan ini, Dolibarr tidak hanya diterjemahkan kepada Bahasa Melayu, tetapi disesuaikan untuk penggunaan koperasi Malaysia.

## Prinsip Terminologi

Release ini mengekalkan prinsip berikut:

1. **Bahasa Melayu Malaysia** digunakan sebagai standard utama.
2. **Konteks koperasi** diberi keutamaan apabila istilah mempunyai makna operasi koperasi.
3. **Istilah fungsi dan modul** ditulis dengan huruf besar pada permulaan apabila menjadi label UI.
4. **Istilah teknikal antarabangsa** seperti API, OAuth2, SMTP, IMAP, Webhook, OpenID Connect dan Content-Security-Policy dikekalkan apabila perlu.
5. **Terjemahan literal dielakkan** jika ia mengurangkan kefahaman pengguna sebenar.
6. **Konsistensi antara modul** lebih penting daripada variasi gaya terjemahan.

## Status Kualiti

Status validasi release:

```text
All lang/ms_MY/*.lang: PASS
Duplicate key cleanup: PASS
Controlled terminology scan: PASS
Git working tree before tag: clean
Release tag: ms_MY-v1.0.1
```

## Peranan Sebagai Foundation

Release ini menjadi batu asas untuk:

- perluasan istilah seterusnya daripada 5001 hingga 10000;
- penyempurnaan sehingga 15088 istilah penuh Dolibarr;
- pematangan Bahasa Melayu Malaysia untuk Dolibarr;
- pembinaan variasi koperasi yang lebih lengkap;
- penyediaan laluan masa depan ke upstream translation workflow.

## Penutup

`ms_MY-v1.0.1` ialah release yang menandakan bahawa Sengiala Language Pack telah melepasi tahap eksperimen awal dan memasuki tahap foundation yang boleh digunakan, diuji, ditambah baik, dan diteruskan secara berurutan.

Ia menjadi asas rasmi kepada release-release seterusnya bagi Bahasa Melayu Malaysia untuk Dolibarr Versi Koperasi.