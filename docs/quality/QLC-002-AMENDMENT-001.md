# QLC-002 Amendment 001 — Consolidation, Agenda Events, Membership Exclusion and Interface Phrasing

**Programme:** Sengiala Language Pack  
**Parent artefact:** QLC-002 — Terminology Governance and Controlled Glossary  
**Amendment:** QLC-002-AMD-001  
**Sprint:** 23B  
**Status:** Amendment Candidate

## 1. Purpose

This amendment formalises terminology decisions requested after the acceptance of QLC-002. It extends the controlled glossary without replacing the governing principles of QLC-001 or QLC-002.

## 2. Approved consolidation terminology

The following terminology is mandatory where the source concept is formal consolidation:

| Source | Approved `ms_MY` |
|---|---|
| Consolidation | Penyatuan |
| Consolidate | Satukan |
| Consolidated | Disatukan |

The grammatical role must be preserved:

- **Penyatuan** is the noun describing the process or result.
- **Satukan** is the imperative interface action.
- **Disatukan** is the completed passive state.

`Gabungkan` or `Digabungkan` may only be used where the runtime meaning is ordinary joining or merging rather than formal consolidation.

## 3. Agenda-module rule for “Events”

Inside the Dolibarr **Agenda module**, the collective source label `Events` shall be translated as **Perkara**.

This decision is strictly scoped to the Agenda module. It does not establish `Perkara` as the universal translation of `event` or `events`.

Outside the Agenda module, reviewers must select the term matching the actual context, such as:

- **Acara** for organised activities;
- **Peristiwa** for an occurrence;
- **Kejadian** for an incident or event occurrence;
- another approved contextual term where required.

## 4. Membership exclusion terminology

Within cooperative membership administration, `Excluded members` shall be translated as **Anggota Ditolak**.

This term represents members excluded or rejected by the applicable membership process. It must not be replaced with `Ahli Ditolak`, because **Anggota** is the controlled cooperative term under QLC-002.

Where the source context means a temporary filter omission rather than a membership decision, reviewers must select a contextually accurate alternative instead of applying this term automatically.

## 5. Pending-action phrasing rule

Where an English source label expresses a required action that has not yet been completed, the Malay form shall use:

> **Perlu + passive verb**

The construction `Untuk + passive verb` shall not be used for this workflow meaning because it reads as purpose or intended use rather than an outstanding requirement.

Approved examples:

| Non-preferred | Approved |
|---|---|
| Untuk Disatukan | Perlu Disatukan |
| Untuk Dibayar | Perlu Dibayar |
| Untuk Diluluskan | Perlu Diluluskan |

The rule applies generally to equivalent pending-action labels, including forms such as:

- `Untuk Disahkan` → `Perlu Disahkan`
- `Untuk Dihantar` → `Perlu Dihantar`
- `Untuk Diproses` → `Perlu Diproses`
- `Untuk Disemak` → `Perlu Disemak`

## 6. Standard form for “new”

The approved general interface translation of `New` is **Baru**.

`Baharu` shall be replaced with **Baru** in ordinary interface labels, commands, statuses and descriptive text unless a proper name, quoted source, legal title or externally controlled wording requires preservation.

Examples:

- `New invoice` → `Invois Baru`
- `New member` → `Anggota Baru`
- `Create new` → `Cipta Baru`

This decision establishes repository-wide consistency and does not alter proper names or source-controlled titles.

## 7. Draft label ordering

For compound labels consisting of a noun and the state `Draft`, the approved Malay order is:

> **Draf + Kata Nama**

The pattern `Kata Nama + Draf` shall not be used for document or transaction labels.

Approved examples:

| Non-preferred | Approved |
|---|---|
| Invois Draf | Draf Invois |
| Pesanan Draf | Draf Pesanan |
| Sebut Harga Draf | Draf Sebut Harga |
| Kontrak Draf | Draf Kontrak |

A standalone state value remains **Draf**. Reviewers must distinguish a compound object label from a sentence where `draf` functions differently.

## 8. Scope boundaries

The replacement of `Untuk` with `Perlu` is not a blind textual substitution.

`Untuk` remains correct when it expresses:

- purpose: `Untuk kegunaan pentadbir`;
- recipient or intended party: `Untuk pelanggan`;
- destination or allocation: `Untuk projek ini`;
- a normal infinitive construction in explanatory prose.

Similarly:

- `Baru` shall not overwrite protected proper names or quoted external wording;
- `Draf + Kata Nama` applies to compound interface labels, not every sentence containing `draf`;
- `Anggota Ditolak` applies to cooperative membership exclusion, not generic filtered-out records.

Reviewers must confirm the runtime function before applying any correction.

## 9. Review classification

Occurrences that use `Untuk + passive verb` for an outstanding action shall normally be classified:

- **L2 — Major** when the wording materially obscures workflow meaning;
- **L3 — Moderate** when the meaning remains understandable but is linguistically non-preferred.

The following are normally **L3 — Moderate** unless they materially mislead the user:

- `Baharu` instead of the approved `Baru`;
- reversed draft-label order;
- non-controlled wording for `Excluded members`.

Incorrect use of `Events` outside or inside the Agenda context shall be classified according to its effect on user understanding.

## 10. Implementation requirement

A subsequent correction batch shall:

1. scan the repository for consolidation terminology;
2. identify Agenda-module keys whose source concept is `Events`;
3. identify cooperative membership occurrences of `Excluded members`;
4. identify pending-action translations using `Untuk + passive verb`;
5. identify ordinary interface occurrences of `Baharu`;
6. identify compound labels using `Kata Nama + Draf`;
7. review each occurrence contextually rather than applying unqualified global replacement;
8. preserve all keys, placeholders, markup and runtime syntax;
9. run the complete validator suite after correction.

## 11. Controlled glossary changes

This amendment adds the following glossary records:

- `PROC-001` — Consolidation → Penyatuan
- `PROC-002` — Consolidate → Satukan
- `PROC-003` — Consolidated → Disatukan
- `AGENDA-001` — Events → Perkara, Agenda module only
- `COOP-007` — Excluded members → Anggota Ditolak
- `WF-001` — To be consolidated → Perlu Disatukan
- `WF-002` — To be paid → Perlu Dibayar
- `WF-003` — To be approved → Perlu Diluluskan
- `UI-008` — New → Baru
- `DOC-004` — Draft compound label → Draf + Kata Nama

## 12. Acceptance criteria

This amendment is accepted when:

1. all ten terminology and phrasing records are present in the controlled glossary;
2. the Agenda-only scope of `Events → Perkara` is explicit;
3. `Excluded members → Anggota Ditolak` is scoped to cooperative membership administration;
4. the pending-action construction `Perlu + passive verb` is established;
5. `Baru` is established as the standard general interface form;
6. `Draf + Kata Nama` is established for compound draft labels;
7. legitimate contextual exceptions remain protected from blind replacement;
8. no runtime language value is modified by this governance amendment.

## 13. Certification statement

Approval of QLC-002-AMD-001 makes these decisions authoritative for all subsequent `ms_MY` linguistic review and correction work.
