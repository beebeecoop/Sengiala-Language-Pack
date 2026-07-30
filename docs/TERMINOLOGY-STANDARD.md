# Malay Terminology Standard

## Purpose

This document records controlled terminology for the Dolibarr Bahasa Melayu Malaysia language pack.

The goal is to keep translation consistent across Dolibarr modules while preserving terminology suitable for Malaysian cooperative operations.

## Controlled Cooperative Terms

| Source term | Approved Malay term | Notes |
| --- | --- | --- |
| Member | Anggota | Use for cooperative membership context. |
| Membership | Keanggotaan | Use for records, applications and membership module context. |
| Share | Modal Syer | Use when referring to cooperative member share capital. |
| Bonus Share | Syer Bonus | Use when referring to bonus share allocation. |
| Patronage | Potongan Langganan | Use for cooperative patronage-related distribution or deduction context. |
| Bonus | Bonus Langganan | Use when bonus refers to cooperative patronage/member benefit. |
| Appropriation | Pembahagian Keuntungan | Use for cooperative profit appropriation context. |
| Balance Sheet | Kunci Kira-Kira | Use for formal financial statement context. |
| Profit and Loss | Penyata Untung Rugi | Use for accounting report context. |
| Accounting | Perakaunan | General accounting context. |
| Invoice | Invois | Customer or supplier invoice. |
| Customer | Pelanggan | Commercial customer context. |
| Supplier | Pembekal | Vendor/supplier context. |
| Payment | Bayaran | General payment context. |
| Receipt | Resit | Proof of payment context. |

## Translation Rules

1. Prefer clear Bahasa Melayu Malaysia over literal translation.
2. Preserve Dolibarr functional meaning.
3. Avoid mixing cooperative-specific terms into non-cooperative contexts unless the key clearly belongs to membership or cooperative finance.
4. Use `Anggota` for cooperative members, not `Ahli`, unless the upstream context clearly refers to a generic group member.
5. Use `Modal Syer` for share capital and `Syer Bonus` for bonus shares.
6. Use `Pembahagian Keuntungan` for appropriation in cooperative financial reporting context.

## Review Status

This standard is an initial foundation and should be expanded as more Dolibarr `.lang` files are translated.
