# Sengiala Language Pack

Pek bahasa dan terminologi Bahasa Melayu Malaysia untuk Dolibarr dan SengialaSuite.

## Dolibarr Malay Translation Sprint 01

Sprint 01 memulakan asas rasmi `ms_MY` untuk Dolibarr dengan tumpuan kepada:

- struktur folder bahasa yang boleh dipasang ke dalam Dolibarr;
- istilah koperasi Malaysia yang konsisten;
- terjemahan permulaan untuk label umum, anggota, kewangan dan pentadbiran;
- pemisahan jelas antara pek bahasa Dolibarr dan pembangunan SengialaSuite Platform.

## Prinsip

1. **Dolibarr compatibility first** — format fail hendaklah kekal serasi dengan konvensyen `lang/<locale>/*.lang` Dolibarr.
2. **Malay terminology first** — istilah hendaklah menggunakan Bahasa Melayu Malaysia yang profesional dan mudah difahami.
3. **Cooperative accuracy first** — istilah koperasi seperti Anggota, Modal Syer, Syer Bonus, Potongan Langganan dan Pembahagian Keuntungan hendaklah dikawal secara konsisten.
4. **No core modification** — pek bahasa tidak mengubah kod teras Dolibarr.

## Struktur awal

```text
lang/
└── ms_MY/
    ├── README.md
    ├── main.lang
    ├── admin.lang
    ├── members.lang
    └── accounting.lang

docs/
├── DOLIBARR-MALAY-TRANSLATION-SPRINT-01.md
└── TERMINOLOGY-STANDARD.md
```
