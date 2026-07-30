# Malay Terminology Standard

## Purpose

This document records controlled terminology for the Dolibarr Bahasa Melayu Malaysia language pack.

The goal is to keep translation consistent across Dolibarr modules while preserving terminology suitable for Malaysian cooperative operations.

## Controlled Cooperative Terms

| Source term | Approved Malay term | Notes |
| --- | --- | --- |
| Member | Anggota | Use for cooperative membership context. |
| Membership | Keanggotaan | Use for records, applications and membership module context. |
| Membership Fee | Fi Masuk | Use for entrance/admission fee into membership. |
| Member Subscription | Caruman Anggota | Use in Dolibarr members module where subscription means member contribution. |
| Subscription Payment | Bayaran Caruman Anggota | Use for payment of member subscription/contribution. |
| Share | Modal Syer | Use when referring to cooperative member share capital. |
| Bonus Share | Syer Bonus | Use when referring to bonus share allocation. |
| Patronage | Potongan Langganan | Use for cooperative patronage-related distribution or deduction context. |
| Bonus | Bonus Langganan | Use when bonus refers to cooperative patronage/member benefit. |
| Appropriation | Pembahagian Keuntungan | Use for cooperative profit appropriation context. |
| Balance Sheet | Kunci Kira-Kira | Use for formal financial statement context. |
| Profit and Loss | Penyata Untung Rugi | Use for accounting report context. |

## Controlled Accounting Terms

| Source term | Approved Malay term | Notes |
| --- | --- | --- |
| Accounting | Perakaunan | General accounting context. |
| Account | Akaun | General account context. |
| Accountancy | Perakaunan | Use where Dolibarr refers to the accounting discipline/module. |
| Bookkeeping | Simpan Kira | Use for bookkeeping function/context. |
| Double Entry Bookkeeping | Catatan Bergu | Use for double-entry accounting method. |
| Account Entry | Catatan Akaun | Use only if upstream key clearly refers to an account entry rather than a journal entry. |
| Accounting Entry | Catatan Perakaunan | Use for formal accounting entry. |
| Chart of Accounts | Carta Akaun | Use for accounting account structure. |
| Asset | Aset | Do not leave as English `Asset`. |
| Liability | Liabiliti | Formal accounting term. |
| Equity | Ekuiti | Formal accounting term. |
| Income | Pendapatan | Use for broader income category. |
| Revenue | Hasil | Use for operating revenue, sales and service revenue context. |
| Expense | Perbelanjaan | Formal accounting term. |
| Cost | Kos | General cost context. |
| Debit | Debit | Preserve accounting term. |
| Credit | Kredit | Preserve accounting term. |
| Posting | Pengeposan | Use for technical accounting posting concept. |
| Post Entry | Hantar Catatan | Use for user-facing action label. |
| Reconciliation | Penyesuaian | Standard accounting and bank reconciliation term. |
| Bank Reconciliation | Penyesuaian Bank | Use for matching bank records with accounting records. |
| Reconcile | Sesuaikan | Action verb for reconciliation. |
| Reconciled | Telah Disesuaikan | Completed reconciliation status. |
| Unreconciled | Belum Disesuaikan | Pending reconciliation status. |
| Adjustment | Pelarasan | Use for accounting adjustment, not reconciliation. |
| Carried Forward Balance | Baki Bawa Hadapan | Use for balance carried forward into the next period. |
| Brought Forward Balance | Baki Bawa Bawah | Use for balance brought forward from the previous period. |
| General Ledger | Lejar Am | Formal accounting report. |
| Trial Balance | Imbangan Duga | Formal accounting report. |
| Income Statement | Penyata Pendapatan | Use when the upstream key is specifically `IncomeStatement`. |
| Profit and Loss Statement | Penyata Untung Rugi | Use when the upstream key is specifically `ProfitAndLossStatement` or `ProfitAndLoss`. |
| Cash Flow Statement | Penyata Aliran Tunai | Formal financial statement. |

## Controlled Commercial Terms

| Source term | Approved Malay term | Notes |
| --- | --- | --- |
| Invoice | Invois | Customer or supplier invoice. |
| Bill | Invois | Use where Dolibarr bill means invoice document. |
| Credit Note | Nota Kredit | Commercial and accounting document context. |
| Debit Note | Nota Debit | Commercial and accounting document context. |
| Customer | Pelanggan | Commercial customer context. |
| Supplier | Pembekal | Vendor/supplier context. |
| Vendor | Pembekal | Align with supplier. |
| Third Party | Pihak Ketiga | Dolibarr third-party module context. |
| Prospect | Prospek | Potential customer context. |
| Payment | Bayaran | General payment context. |
| Receipt | Resit | Proof of payment context. |
| Order | Pesanan | Customer or supplier order. |
| Delivery | Serahan | Use for delivery event or goods handover. |
| Shipment | Penghantaran | Use for shipping/logistics movement. |
| Subscription | Langganan | Use only for general/commercial subscription context, not cooperative member contributions. |

## Controlled Product and Stock Terms

| Source term | Approved Malay term | Notes |
| --- | --- | --- |
| Product | Produk | General product context. |
| Service | Perkhidmatan | General service context. |
| Stock | Stok | Inventory stock. |
| Warehouse | Stor | Use `Stor`, not `Gudang`, for concise Dolibarr UI. |
| Selling Price | Harga Jualan | Customer-facing sale price. |
| Cost Price | Harga Kos | Internal cost basis. |
| Purchase Price | Harga Belian | Supplier purchase price. |
| Barcode | Kod Bar | Product identification. |
| Lot | Lot | Preserve common inventory term. |
| Batch | Kelompok | Batch grouping. |
| Serial Number | Nombor Siri | Product traceability. |
| Expiry Date | Tarikh Luput | Expiry-controlled products. |

## Translation Rules

1. Prefer clear Bahasa Melayu Malaysia over literal translation.
2. Preserve Dolibarr functional meaning.
3. Avoid mixing cooperative-specific terms into non-cooperative contexts unless the key clearly belongs to membership or cooperative finance.
4. Use `Anggota` for cooperative members, not `Ahli`, unless the upstream context clearly refers to a generic group member.
5. Use `MembershipFee=Fi Masuk` in the members module for entrance/admission fee.
6. Use `Modal Syer` for share capital and `Syer Bonus` for bonus shares.
7. Use `Pembahagian Keuntungan` for appropriation in cooperative financial reporting context.
8. Use `Subscription=Caruman Anggota` in the members module; use `Subscription=Langganan` only in general/commercial context.
9. Use `Income=Pendapatan` and `Revenue=Hasil`; do not translate both as `Hasil`.
10. Use `IncomeStatement=Penyata Pendapatan` and `ProfitAndLossStatement=Penyata Untung Rugi` consistently.
11. Use `Reconciliation=Penyesuaian`, `BankReconciliation=Penyesuaian Bank`, `Reconcile=Sesuaikan`, `Reconciled=Telah Disesuaikan`, and `Unreconciled=Belum Disesuaikan` consistently.
12. Use `Adjustment=Pelarasan`; do not use `Penyelarasan` for reconciliation because it is closer to adjustment/alignment.
13. Use `PostEntry=Hantar Catatan` for user-facing action labels, while retaining `Posting=Pengeposan` where the technical accounting concept is required.
14. Use `DoubleEntryBookkeeping=Catatan Bergu`, not `Simpan Kira Bergu`.
15. Use `CarriedForwardBalance=Baki Bawa Hadapan` and `BroughtForwardBalance=Baki Bawa Bawah` consistently.
16. Use Dolibarr `.lang` format exactly as `Key=Value` with no spaces around `=`.

## Review Status

This standard is part of Dolibarr Malay Translation Sprint 01 and should be expanded as more Dolibarr `.lang` files are translated.
- Delete → Hapus
- Deleted → Dihapuskan
- Delete action sentence → menghapus / menghapuskan
- Deleted sentence form → dihapuskan
