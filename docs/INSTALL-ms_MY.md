# Installation Notes — Bahasa Melayu Malaysia Language Pack

## Purpose

This document explains how to install the Bahasa Melayu Malaysia language pack for Dolibarr.

## Target Language

- Language code: `ms_MY`
- Language name: Bahasa Melayu Malaysia
- Target platform: Dolibarr ERP/CRM

## Installation Path

Copy the `ms_MY` language folder into the Dolibarr language directory:

    htdocs/langs/ms_MY

The expected final structure is:

    htdocs/langs/ms_MY/main.lang
    htdocs/langs/ms_MY/admin.lang
    htdocs/langs/ms_MY/banks.lang
    htdocs/langs/ms_MY/compta.lang
    htdocs/langs/ms_MY/projects.lang

## Installation Steps

1. Download or clone this repository.
2. Copy the folder:

       lang/ms_MY

3. Paste it into the Dolibarr installation language folder:

       htdocs/langs/ms_MY

4. Log in to Dolibarr as an administrator.
5. Go to user preferences or language settings.
6. Select Bahasa Melayu Malaysia if available.
7. Clear cache if the new language entries do not appear immediately.

## Important Notes

This language pack uses Malaysian terminology and cooperative-friendly translations.

Important terminology decisions include:

- Member → Anggota
- Amount → Jumlah
- Invoice / Bill → Invois
- Supplier Invoice → Invois Pembekal
- Warehouse → Stor
- Manufacturing → Pengilangan
- VAT → SST
- Bank Transfer → Pindahan Bank
- Beneficiary → Benefisiari
- Delete → Hapus
- Deleted → Dihapuskan

## Malaysia Tax Standard

For Malaysia, VAT keys in Dolibarr are translated as SST in display values.

Examples:

    VAT=SST
    VATRate=Kadar SST
    VATAmount=Jumlah SST
    TotalVAT=Jumlah SST

## QA Before Use

Before using this language pack in production, run the QA checklist in:

    docs/QA-CHECKLIST-ms_MY.md

## Status

Prepared for release packaging.
