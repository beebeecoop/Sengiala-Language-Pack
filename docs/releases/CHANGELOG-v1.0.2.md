# CHANGELOG ms_MY v1.0.2

## Added

- Expanded `errors.lang` translations.
- Expanded `companies.lang` translations.
- Expanded `compta.lang` translations.
- Expanded `cashdesk.lang`, `exports.lang`, and `holiday.lang`.
- Expanded support module translations:
  - `boxes.lang`
  - `categories.lang`
  - `contracts.lang`
  - `ecm.lang`
  - `hrm.lang`
  - `loan.lang`
- Expanded `main.lang` in three controlled parts.

## Fixed

- Removed duplicate language keys after Sprint 19 expansion.
- Preserved later duplicate occurrence as final value.
- Confirmed no blocked controlled terms remained.
- Confirmed no spacing format issue in `key=value` structure.

## Validation

- Full `lang/ms_MY/*.lang` validation: PASS.
- Duplicate-key check: PASS after cleanup.
- Blocked-term check: PASS.
- Spacing format check: PASS.

## Release Candidate

- Commit baseline: `8c62a96`
- Recommended tag: `ms_MY-v1.0.2`
