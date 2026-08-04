# QLC-002 — Terminology Governance and Controlled Glossary

**Programme:** Sengiala Language Pack  
**Phase:** Quality & Linguistic Certification  
**Sprint:** 23B  
**Status:** Baseline Candidate  
**Parent baseline:** QLC-001 — Linguistic Standards Baseline

## 1. Purpose

QLC-002 establishes the governance system for selecting, approving, applying, reviewing and changing terminology used by the Malaysian Malay (`ms_MY`) language pack.

Its purpose is to ensure that the same business concept is represented by the same approved Malay term across Dolibarr modules, documentation, reports and runtime interfaces, while allowing controlled contextual exceptions where one English source term represents more than one concept.

## 2. Authority

The controlled glossary in `QLC-002-CONTROLLED-GLOSSARY.csv` is the authoritative terminology register for `ms_MY`.

Where a translated value conflicts with an approved glossary entry, the glossary term prevails unless:

1. the runtime context represents a materially different concept;
2. the approved term would be misleading or technically incorrect in that context; and
3. the exception is documented and approved through the terminology change process.

QLC-002 operates under the linguistic and runtime-safety requirements of QLC-001.

## 3. Governance principles

1. **Concept before wording** — determine the business concept before selecting a translation.
2. **One concept, one preferred term** — use one approved Malay term consistently for the same concept.
3. **Context over literal equivalence** — do not force one Malay term across unrelated meanings of the same English word.
4. **Malaysian usage** — prefer established Malaysian Malay suitable for professional software.
5. **Domain accuracy** — accounting, cooperative, tax, legal, HR and commercial meanings must remain precise.
6. **Runtime clarity** — a term must remain understandable when displayed without its English source.
7. **Traceable change** — every addition, replacement, deprecation or exception must be reviewable.
8. **Backward awareness** — terminology changes must consider reports, search behaviour, user familiarity and documentation impact.

## 4. Glossary record model

Each controlled glossary entry contains:

| Field | Meaning |
|---|---|
| `term_id` | Stable identifier for governance and review references |
| `source_term` | English source concept or canonical source wording |
| `approved_ms_MY` | Mandatory preferred Malay term |
| `domain` | Primary business or application domain |
| `context_note` | Meaning boundary and intended usage |
| `status` | `approved`, `conditional`, `deprecated` or `reserved` |
| `avoid_terms` | Terms that must not be used for the same concept |
| `exception_rule` | Conditions permitting a different translation |
| `authority` | Baseline or decision approving the term |

Stable `term_id` values must not be recycled when an entry is deprecated.

## 5. Term status

### 5.1 Approved

The term is mandatory for the defined concept and context.

### 5.2 Conditional

The term is approved only for the context stated in the record. Reviewers must verify runtime meaning before applying it.

### 5.3 Deprecated

The term remains recorded for traceability but must not be introduced into new translations. Existing occurrences must be migrated through reviewed correction batches.

### 5.4 Reserved

The term is intentionally retained in English, as an abbreviation, or as a product identity because translation would reduce clarity or alter identity.

## 6. Terminology domains

The initial register covers:

- Cooperative and membership;
- Finance and accounting;
- Tax and statutory reporting;
- Commercial and CRM;
- Procurement and supplier management;
- Human resources;
- System and interface actions;
- Documents and workflow states.

Additional domains may be introduced without changing this governance model.

## 7. Mandatory controlled terms

The following decisions are foundational:

| Concept | Approved term |
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

The CSV glossary expands these decisions with context boundaries and prohibited alternatives.

## 8. Polysemy and contextual variants

A source word may require different translations when it represents different concepts. Examples:

- `Share` may mean **Syer** in cooperative capital, **Kongsi** as an interface action, or **Bahagian** as a proportion.
- `Order` may mean **Pesanan** in commerce, **Arahan** in workflow, or **Susunan** in sorting.
- `Account` may mean **Akaun** in finance, **Rekod pengguna** in authentication context, or **Pelanggan** only where the application explicitly uses account as a customer relationship concept.
- `Return` may mean **Pulangan**, **Pemulangan**, **Kembali**, or **Penyata** depending on finance, logistics, navigation or statutory context.

Reviewers must classify the concept before applying a glossary entry.

## 9. Prohibited terminology behaviour

The following practices are not permitted:

- translating solely from the English word without checking runtime context;
- alternating between synonyms for stylistic variety;
- using Indonesian terminology where an established Malaysian equivalent exists;
- replacing a domain term merely because a shorter informal term is available;
- changing approved terminology inside one file without assessing repository-wide occurrences;
- changing placeholders, markup, keys or technical identifiers while correcting terminology;
- silently introducing a new preferred term without updating the glossary.

## 10. Exception control

A glossary exception must record:

- source key and file;
- glossary `term_id` affected;
- actual runtime context;
- proposed alternative translation;
- reason the approved term is unsuitable;
- affected modules or reports;
- severity if left unchanged;
- reviewer and decision;
- approval date and follow-up reference.

An exception applies only to the approved scope. It does not create a new general synonym.

## 11. Change control

Terminology changes fall into four categories:

| Change type | Meaning | Required action |
|---|---|---|
| Add | New concept enters the register | Add stable ID and review scope |
| Clarify | Existing wording retained; context note improved | Review affected occurrences if ambiguity existed |
| Replace | Preferred term changes | Repository-wide impact scan and migration plan |
| Deprecate | Term prohibited for new use | Record replacement and correction backlog |

Replacement or deprecation of a foundational term requires explicit PR documentation and must not be bundled into an unrelated translation batch.

## 12. Review workflow

1. Identify a candidate term or inconsistency.
2. Determine the actual business concept and runtime role.
3. Search existing translations and glossary entries.
4. Select the applicable approved term or prepare an exception/change request.
5. Assess repository-wide impact.
6. Correct translations in a dedicated reviewed batch.
7. Run all technical validators.
8. Record the decision and evidence.
9. Update the glossary when governance status changes.

## 13. Severity mapping

- **L1 — Critical:** terminology causes unsafe action, legal/financial distortion, or runtime failure.
- **L2 — Major:** incorrect domain concept, misleading role, or material cross-module inconsistency.
- **L3 — Moderate:** non-preferred synonym, awkward terminology, or inconsistent but understandable usage.
- **L4 — Cosmetic:** capitalisation or presentation defect that does not change the concept.

L1 and L2 findings block the affected certification scope.

## 14. Validation requirements

Every terminology correction batch must preserve and validate:

- translation key parity;
- placeholder count, type and order;
- duplicate-key absence;
- language-file syntax and encoding;
- HTML, entities, escapes and tokens;
- missing-key count;
- `git diff --check`;
- runtime/UI evidence when context cannot be proven from source files alone.

## 15. Acceptance criteria

QLC-002 is accepted when:

1. the governance authority and record model are established;
2. foundational terminology is represented in a controlled machine-readable register;
3. status, exception and change-control rules are documented;
4. contextual variants are governed without weakening consistency;
5. prohibited alternatives are recorded where material;
6. a reusable terminology change-request template exists;
7. no translation key or runtime value is changed by this documentation increment.

## 16. Certification statement

Approval of QLC-002 declares the controlled glossary and its governance process authoritative for all subsequent `ms_MY` linguistic review and certification work. Terminology corrections shall be traceable to glossary entries, approved exceptions or documented change decisions.
