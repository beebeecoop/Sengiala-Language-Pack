# M2-02 — Banking & Cash Foundation

## Status

- Milestone: M2 — `ms_MY` Foundation
- Increment: M2-02
- Baseline: Dolibarr 23.0.3
- Primary file: `lang/ms_MY/banks.lang`
- Compatibility layer: `lang/ms_MY/cash.lang`
- Status: Draft implementation

## Purpose

M2-02 establishes the official Bahasa Melayu Malaysia terminology for banking, cash management, account movements, internal transfers and bank reconciliation in Sengiala Language Pack.

The increment treats `banks.lang` as the authoritative Dolibarr module file. `cash.lang` remains a SengialaSuite compatibility layer for cash-management concepts that may be consumed by platform modules outside the native Dolibarr language catalogue.

## Scope

M2-02 covers:

- bank and cash accounts;
- current and savings accounts;
- account balances;
- bank entries and cash entries;
- bank reconciliation;
- credit transfers and internal transfers;
- direct debit instructions;
- cheque deposit processing;
- cash receipts and cash payments;
- petty cash terminology;
- cross-file terminology consistency.

## Normative Terminology

| Concept | Official `ms_MY` term |
|---|---|
| Bank Account | Akaun Bank |
| Cash Account | Akaun Tunai |
| Bank Entry | Catatan Bank |
| Bank Reconciliation | Penyelarasan Bank |
| Reconcile | Selaraskan |
| Reconciled | Telah Diselaraskan |
| Unreconciled | Belum Diselaraskan |
| Credit Transfer | Pindahan Kredit |
| Internal Transfer | Pindahan Dalaman |
| Direct Debit Order | Arahan Debit Terus |
| Cash Book | Buku Tunai |
| Petty Cash | Wang Tunai Runcit |

## Architectural Decision

Dolibarr 23.0.3 provides `banks.lang` as the native banking and cash language module. Therefore:

1. Native Dolibarr keys remain in `banks.lang`.
2. `cash.lang` must not be treated as an upstream Dolibarr file.
3. `cash.lang` is retained only as a SengialaSuite compatibility vocabulary.
4. Shared concepts must use identical official terms across both files.
5. Future additions must preserve upstream keys and must not invent replacement native module names.

## Quality Gate

Run the generic syntax validator:

```powershell
php scripts/validate-lang.php lang/ms_MY/banks.lang
php scripts/validate-lang.php lang/ms_MY/cash.lang
```

Run the M2-02 domain validator:

```powershell
php scripts/validate-banking-cash.php
```

Expected result:

```text
PASS M2-02 Banking & Cash Foundation: 204 banking keys and 38 cash keys validated.
```

## Acceptance Criteria

M2-02 is complete when:

- both language files pass the generic validator;
- the domain validator passes;
- required normative terms are present;
- shared Banking–Cash terminology is consistent;
- terminology decisions are recorded in the Translation Decision Log;
- the increment is reviewed and merged into `main`.
