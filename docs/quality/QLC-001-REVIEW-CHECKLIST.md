# QLC-001 Review Checklist

Use this checklist for every linguistic review batch.

## A. Meaning and context

- [ ] The translated value preserves the functional meaning of the source.
- [ ] The text matches its runtime role: command, label, title, state, warning, error or explanation.
- [ ] The subject and business context are correctly identified.
- [ ] No literal translation creates ambiguity or unnatural Malay.

## B. Terminology

- [ ] Controlled terminology is used consistently.
- [ ] Cooperative, finance, accounting and administrative terms are contextually correct.
- [ ] Product names, codes and technical identifiers remain intact where required.
- [ ] Any justified terminology exception is documented.

## C. Language quality

- [ ] Malaysian Malay usage is standard and natural.
- [ ] Grammar, spelling and punctuation are correct.
- [ ] Capitalisation follows interface style rules.
- [ ] The wording is concise enough for the intended UI surface.

## D. Runtime safety

- [ ] Translation key is unchanged.
- [ ] Placeholder count, type and order match the source.
- [ ] HTML, entities, escape sequences and tokens are preserved.
- [ ] No leading or trailing whitespace is introduced.
- [ ] File syntax and encoding remain valid.

## E. Severity and disposition

- [ ] The finding is classified as L1, L2, L3 or L4.
- [ ] L1 and L2 findings are resolved before certification.
- [ ] Deferred L3 findings include a reason and follow-up reference.
- [ ] L4 findings are either corrected or assigned to a maintenance batch.

## F. Validation evidence

- [ ] Repository validator: PASS
- [ ] Placeholder parity: PASS
- [ ] Duplicate-key check: PASS
- [ ] Missing-key check: PASS
- [ ] `git diff --check`: PASS
- [ ] Runtime/UI evidence recorded when applicable

## Review record

- Sprint / Batch:
- Files reviewed:
- Keys reviewed:
- Findings by severity:
- Corrections applied:
- Deferred findings:
- Validator result:
- Reviewer:
- Date:
- Certification decision: PASS / CONDITIONAL PASS / FAIL
