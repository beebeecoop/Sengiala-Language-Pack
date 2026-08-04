# QLC-002 Amendment 001 — Consolidation, Agenda Events and Pending-Action Phrasing

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

## 4. Pending-action phrasing rule

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

## 5. Scope boundary

The replacement of `Untuk` with `Perlu` is not a blind textual substitution.

`Untuk` remains correct when it expresses:

- purpose: `Untuk kegunaan pentadbir`;
- recipient or intended party: `Untuk pelanggan`;
- destination or allocation: `Untuk projek ini`;
- a normal infinitive construction in explanatory prose.

Reviewers must first confirm that the phrase is a **pending requirement or outstanding workflow action**.

## 6. Review classification

Occurrences that use `Untuk + passive verb` for an outstanding action shall normally be classified:

- **L2 — Major** when the wording materially obscures workflow meaning;
- **L3 — Moderate** when the meaning remains understandable but is linguistically non-preferred.

Incorrect use of `Events` outside or inside the Agenda context shall be classified according to its effect on user understanding.

## 7. Implementation requirement

A subsequent correction batch shall:

1. scan the repository for consolidation terminology;
2. identify Agenda-module keys whose source concept is `Events`;
3. identify pending-action translations using `Untuk + passive verb`;
4. review each occurrence contextually rather than applying an unqualified global replacement;
5. preserve all keys, placeholders, markup and runtime syntax;
6. run the complete validator suite after correction.

## 8. Controlled glossary changes

This amendment adds the following glossary records:

- `PROC-001` — Consolidation → Penyatuan
- `PROC-002` — Consolidate → Satukan
- `PROC-003` — Consolidated → Disatukan
- `AGENDA-001` — Events → Perkara, Agenda module only
- `WF-001` — To be consolidated → Perlu Disatukan
- `WF-002` — To be paid → Perlu Dibayar
- `WF-003` — To be approved → Perlu Diluluskan

## 9. Acceptance criteria

This amendment is accepted when:

1. all seven terminology records are present in the controlled glossary;
2. the Agenda-only scope of `Events → Perkara` is explicit;
3. the pending-action construction `Perlu + passive verb` is established;
4. legitimate uses of `Untuk` remain protected from blind replacement;
5. no runtime language value is modified by this governance amendment.

## 10. Certification statement

Approval of QLC-002-AMD-001 makes these decisions authoritative for all subsequent `ms_MY` linguistic review and correction work.
