# QLC-001 — Linguistic Standards Baseline

**Programme:** Sengiala Language Pack  
**Phase:** Quality & Linguistic Certification  
**Sprint:** 23A  
**Status:** Baseline Candidate

## 1. Purpose

QLC-001 establishes the mandatory linguistic, terminology, contextual and runtime-safety standards for the Malaysian Malay (`ms_MY`) language pack. It becomes the governing baseline for all subsequent linguistic review, correction, certification and regression work.

## 2. Scope

The baseline applies to every translated value in the repository, including menus, buttons, forms, help text, warnings, errors, reports, PDF labels, configuration screens and module-specific terminology.

QLC-001 does not replace technical validators. It extends them by certifying whether a technically valid translation is also linguistically correct, contextually appropriate and operationally safe.

## 3. Normative language principles

1. Use standard Malaysian Malay suitable for professional software interfaces.
2. Preserve the functional meaning of the source instead of translating word by word.
3. Prefer concise, natural and unambiguous interface language.
4. Use consistent terminology for the same concept across all modules.
5. Preserve product names, registered names, codes and technical identifiers when translation would change their identity.
6. Avoid Indonesian forms when a recognised Malaysian Malay equivalent exists.
7. Avoid unnecessary English where a clear and established Malay term exists.
8. Retain established technical abbreviations when expansion would reduce clarity or conflict with the application context.

## 4. Interface style rules

### 4.1 Capitalisation

- Use sentence case for ordinary labels and messages.
- Use title case only for page titles, report titles or established proper names.
- Do not copy English capitalisation mechanically.

### 4.2 Commands and actions

Use direct action verbs for buttons and menu commands, for example:

- `Save` → `Simpan`
- `Delete` → `Hapus`
- `Close` → `Tutup`
- `Print` → `Cetak`
- `Search` → `Cari`

### 4.3 Status and state labels

Use noun or adjective forms that describe the state consistently, for example:

- `Draft` → `Draf`
- `Validated` → `Disahkan`
- `Closed` → `Ditutup`
- `Cancelled` → `Dibatalkan`

### 4.4 Messages

- Error messages must state the problem clearly.
- Warning messages must communicate the risk or required attention.
- Success messages must confirm the completed action.
- Avoid vague constructions such as `Tidak mungkin...` when `Tidak dapat...` is clearer.

### 4.5 Punctuation and spacing

- Do not add a full stop to short labels or buttons.
- Use full stops for complete explanatory sentences.
- Preserve intentional line breaks, HTML and escaped characters.
- Do not introduce leading or trailing whitespace.

## 5. Terminology governance

Translations must follow the controlled terminology register. Initial mandatory terms include:

| Source term | Approved `ms_MY` term |
|---|---|
| Member | Anggota |
| Membership | Keanggotaan |
| Share Capital | Modal Syer |
| Bonus Share | Syer Bonus |
| Patronage Rebate | Potongan Langganan |
| Patronage Bonus | Bonus Langganan |
| Balance Sheet | Kunci Kira-Kira |
| Appropriation | Pembahagian Keuntungan |
| Third Party | Pihak Ketiga |
| Supplier | Pembekal |
| Customer | Pelanggan |
| Proposal / Commercial Proposal | Sebut Harga |
| Invoice | Invois |
| Credit Note | Nota Kredit |
| Human Resources Management | Pengurusan Sumber Manusia |

A term may only depart from the register when the source context represents a different concept. Every departure must be documented during review.

## 6. Contextual correctness

A translation is contextually correct only when it matches its actual runtime function. Reviewers must verify:

- whether the text is a command, title, state, field label or explanatory message;
- whether the subject is a customer, supplier, member, user, contact or third party;
- whether the financial meaning is transactional, accounting, tax or cooperative-specific;
- whether singular, plural and grammatical voice remain appropriate;
- whether the translation remains clear when displayed without the source text.

## 7. Runtime-safety requirements

Every linguistic change must preserve:

- translation keys;
- placeholder count, type and order;
- HTML tags and entities;
- escape sequences;
- variable tokens;
- date, number and currency format tokens;
- file encoding and language-file syntax.

A linguistically improved value must not be accepted if it breaks runtime behaviour.

## 8. Quality severity classification

| Level | Classification | Definition | Release effect |
|---|---|---|---|
| L1 | Critical | Wrong meaning, unsafe instruction, financial/legal distortion, broken placeholder or runtime failure | Blocks certification and release |
| L2 | Major | Misleading context, incorrect domain term or material inconsistency | Blocks domain certification |
| L3 | Moderate | Grammar, fluency, style or consistency defect without material operational risk | Must be corrected or formally deferred |
| L4 | Cosmetic | Capitalisation, punctuation, spacing or minor presentation issue | May be grouped into maintenance batches |

## 9. Acceptance criteria

QLC-001 is accepted when:

1. the linguistic principles are documented and approved;
2. the initial controlled terminology register is established;
3. severity levels L1–L4 are adopted;
4. runtime-safety requirements are mandatory for every correction;
5. the review checklist is available;
6. repository validators continue to pass;
7. no missing or duplicate key is introduced.

## 10. Certification statement

Approval of QLC-001 declares this document the authoritative linguistic baseline for the `ms_MY` language pack. Subsequent QLC increments shall trace findings, corrections and certification decisions to this baseline.
