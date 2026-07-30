# METS-001 — Foundation

## Malaysian ERP Terminology Standard

| Field | Value |
|---|---|
| Document ID | METS-001 |
| Title | Foundation |
| Version | 1.0.0-draft |
| Status | Foundation Draft |
| Owner | Sengiala Language Engineering (SLE) |

## 1. Purpose

Malaysian ERP Terminology Standard (METS) ialah piawaian istilah ERP Malaysia yang diwujudkan bagi memastikan penggunaan istilah yang seragam, tepat dan konsisten dalam sistem Enterprise Resource Planning.

METS merupakan rujukan normatif untuk pembangun perisian, penterjemah, organisasi, institusi koperasi, agensi kerajaan, penyedia ERP dan projek sumber terbuka.

METS bukan sekadar koleksi terjemahan. Ia ialah piawaian istilah yang boleh digunakan oleh pelbagai platform ERP.

## 2. Vision

Mewujudkan piawaian istilah ERP Malaysia yang menjadi rujukan utama bagi pembangunan sistem digital negara.

## 3. Mission

METS diwujudkan untuk:

- menyeragamkan istilah ERP;
- meningkatkan kualiti penyetempatan;
- mengurangkan percanggahan istilah;
- menyokong pembangunan ERP Malaysia;
- menyokong transformasi digital koperasi;
- membolehkan penilaian dan pensijilan pematuhan istilah.

## 4. Scope

METS meliputi, tetapi tidak terhad kepada:

- kewangan dan perakaunan;
- perbankan dan belanjawan;
- koperasi dan keanggotaan;
- perolehan dan inventori;
- jualan, CRM dan komersial;
- sumber manusia;
- projek dan aset;
- pembuatan;
- analitik dan tadbir urus.

## 5. Core Principles

### 5.1 Consistency

Satu konsep hendaklah menggunakan satu istilah piawai dalam konteks domain yang sama.

### 5.2 Accuracy

Istilah hendaklah menggambarkan maksud asal dengan tepat.

### 5.3 Malaysian Context

Keutamaan diberikan kepada istilah yang digunakan dalam amalan profesional, undang-undang dan persekitaran perniagaan Malaysia.

### 5.4 Domain Driven

Keputusan istilah dibuat mengikut konteks domain, bukan melalui terjemahan literal semata-mata.

### 5.5 Traceability

Setiap keputusan istilah hendaklah mempunyai nombor rujukan, justifikasi dan sejarah perubahan.

Contoh:

- `FIN-0016`
- `CRM-0008`
- `MEM-0012`

### 5.6 Backward Compatibility

Perubahan istilah hendaklah meminimumkan gangguan terhadap implementasi sedia ada dan menyediakan laluan migrasi apabila perlu.

## 6. Governance

Semua keputusan istilah hendaklah direkodkan melalui Decision Registry.

Setiap rekod sekurang-kurangnya mengandungi:

- nombor keputusan;
- istilah sumber;
- istilah piawai;
- domain;
- justifikasi;
- status;
- tarikh kelulusan;
- sejarah perubahan, jika berkaitan.

## 7. Domain Structure

METS dibahagikan kepada domain berikut:

| Code | Domain |
|---|---|
| M1 | General Foundation |
| M2 | Finance Foundation |
| M3 | Membership Foundation |
| M4 | Commercial Foundation |
| M5 | Procurement Foundation |
| M6 | Inventory Foundation |
| M7 | Manufacturing Foundation |
| M8 | Human Resource Foundation |
| M9 | Asset Foundation |
| M10 | Analytics Foundation |

Domain baharu boleh ditambah melalui proses tadbir urus METS.

## 8. Relationship with SLE

Sengiala Language Engineering (SLE) ialah metodologi yang digunakan untuk membangunkan, menguji dan menyelenggara METS.

```text
METS
  │
  ▼
SLE
  │
  ▼
Language Packs
  │
  ▼
ERP Platforms
```

METS mentakrifkan piawaian. SLE mentadbir proses kejuruteraan bahasa.

## 9. Relationship with Language Packs

Language Pack ialah implementasi platform bagi METS. Dolibarr dan SengialaSuite ialah implementasi awal, tetapi METS kekal bebas daripada mana-mana platform tertentu.

## 10. Versioning

METS menggunakan Semantic Versioning:

- **Major** — perubahan piawaian yang tidak serasi;
- **Minor** — peluasan domain atau penambahan keupayaan;
- **Patch** — pembetulan kecil tanpa perubahan makna normatif.

## 11. Compliance

Sistem atau language pack boleh mengisytiharkan pematuhan mengikut domain dan versi METS.

Pematuhan hendaklah disokong oleh:

- pemetaan istilah;
- rekod keputusan;
- keputusan validator;
- laporan jurang;
- bukti versi implementasi.

## 12. Initial Roadmap

Pembangunan awal memberi tumpuan kepada:

1. M1 — General Foundation;
2. M2 — Finance Foundation;
3. Cooperative Finance;
4. GP23 Cooperative Financial Reporting;
5. domain ERP lain secara berperingkat.

## 13. Intellectual Property and Openness

METS dibangunkan sebagai piawaian terbuka melalui proses Sengiala Language Engineering. Dokumentasi, metodologi dan keputusan istilah hendaklah kekal telus, boleh dijejaki dan diselenggara melalui repositori rasmi.

## 14. Foundation Declaration

METS diwujudkan sebagai asas standardisasi istilah ERP Malaysia.

Semua istilah yang diterbitkan hendaklah konsisten, tepat, boleh diaudit dan sesuai dengan konteks Malaysia. Piawaian ini direka untuk menyokong pelbagai implementasi ERP, termasuk SengialaSuite, Dolibarr dan platform lain pada masa hadapan.

**One Standard. Multiple ERP Platforms.**
