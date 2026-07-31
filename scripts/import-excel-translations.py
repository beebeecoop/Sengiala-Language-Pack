#!/usr/bin/env python3
"""
Import translation rows from an Excel .xlsx file into Dolibarr .lang files.

Default Excel layout:
  Column A = translation key
  Column B = translated value

This script is dependency-free. It reads .xlsx using Python standard library
only, so it can run on a clean Windows/XAMPP development machine.
"""
from __future__ import annotations

import argparse
import csv
import re
import sys
import zipfile
from datetime import datetime
from pathlib import Path
from typing import Dict, List, Optional, Tuple
from xml.etree import ElementTree as ET

NS = {
    "main": "http://schemas.openxmlformats.org/spreadsheetml/2006/main",
    "rel": "http://schemas.openxmlformats.org/officeDocument/2006/relationships",
    "pkgrel": "http://schemas.openxmlformats.org/package/2006/relationships",
}

LANG_LINE_RE = re.compile(r"^\s*([^#\s][^=]*)=(.*)$")
CELL_REF_RE = re.compile(r"^([A-Z]+)([0-9]+)$")


def col_to_index(col: str) -> int:
    col = col.strip().upper()
    if not re.fullmatch(r"[A-Z]+", col):
        raise ValueError(f"Invalid Excel column: {col!r}")
    result = 0
    for ch in col:
        result = result * 26 + (ord(ch) - ord("A") + 1)
    return result - 1


def normalise_value(value: str) -> str:
    # Dolibarr .lang values must stay on one physical line.
    return value.replace("\r\n", "\\n").replace("\n", "\\n").replace("\r", "\\n").strip()


def xml_text(node: ET.Element) -> str:
    return "".join(node.itertext())


def read_shared_strings(zf: zipfile.ZipFile) -> List[str]:
    try:
        data = zf.read("xl/sharedStrings.xml")
    except KeyError:
        return []
    root = ET.fromstring(data)
    return [xml_text(si) for si in root.findall("main:si", NS)]


def get_sheet_path(zf: zipfile.ZipFile, sheet_name: Optional[str]) -> str:
    workbook = ET.fromstring(zf.read("xl/workbook.xml"))
    rels = ET.fromstring(zf.read("xl/_rels/workbook.xml.rels"))

    rel_map: Dict[str, str] = {}
    for rel in rels.findall("pkgrel:Relationship", NS):
        rid = rel.attrib.get("Id")
        target = rel.attrib.get("Target", "")
        if rid:
            rel_map[rid] = target

    sheets = workbook.findall("main:sheets/main:sheet", NS)
    if not sheets:
        raise ValueError("Workbook has no sheets")

    selected = sheets[0]
    if sheet_name:
        selected = None
        for sheet in sheets:
            if sheet.attrib.get("name") == sheet_name:
                selected = sheet
                break
        if selected is None:
            available = ", ".join(sheet.attrib.get("name", "") for sheet in sheets)
            raise ValueError(f"Sheet {sheet_name!r} not found. Available sheets: {available}")

    rid = selected.attrib.get(f"{{{NS['rel']}}}id")
    if not rid or rid not in rel_map:
        raise ValueError("Unable to resolve sheet relationship")

    target = rel_map[rid]
    if target.startswith("/"):
        target = target.lstrip("/")
    elif not target.startswith("xl/"):
        target = "xl/" + target
    return target


def read_excel_rows(
    excel_path: Path,
    key_col: str,
    value_col: str,
    sheet_name: Optional[str],
    start_row: int,
    skip_header: bool,
) -> List[Tuple[int, str, str]]:
    key_index = col_to_index(key_col)
    value_index = col_to_index(value_col)
    first_data_row = start_row + (1 if skip_header else 0)

    rows: List[Tuple[int, str, str]] = []
    with zipfile.ZipFile(excel_path) as zf:
        shared_strings = read_shared_strings(zf)
        sheet_path = get_sheet_path(zf, sheet_name)
        root = ET.fromstring(zf.read(sheet_path))

        for row in root.findall(".//main:sheetData/main:row", NS):
            row_number = int(row.attrib.get("r", "0"))
            if row_number < first_data_row:
                continue

            cells: Dict[int, str] = {}
            for cell in row.findall("main:c", NS):
                ref = cell.attrib.get("r", "")
                match = CELL_REF_RE.match(ref)
                if not match:
                    continue
                col_index = col_to_index(match.group(1))
                cell_type = cell.attrib.get("t")

                if cell_type == "s":
                    raw = cell.findtext("main:v", default="", namespaces=NS)
                    value = shared_strings[int(raw)] if raw else ""
                elif cell_type == "inlineStr":
                    inline = cell.find("main:is", NS)
                    value = xml_text(inline) if inline is not None else ""
                else:
                    value = cell.findtext("main:v", default="", namespaces=NS)
                cells[col_index] = value

            key = str(cells.get(key_index, "")).strip()
            value = normalise_value(str(cells.get(value_index, "")))
            if key or value:
                rows.append((row_number, key, value))
    return rows


def read_text(path: Path) -> str:
    return path.read_text(encoding="utf-8-sig")


def write_text(path: Path, text: str) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_text(text, encoding="utf-8", newline="\n")


def scan_lang_dir(lang_dir: Path) -> Dict[str, List[Tuple[Path, int, str]]]:
    index: Dict[str, List[Tuple[Path, int, str]]] = {}
    if not lang_dir.exists():
        return index

    for path in sorted(lang_dir.glob("*.lang")):
        lines = read_text(path).splitlines()
        for i, line in enumerate(lines):
            match = LANG_LINE_RE.match(line)
            if not match:
                continue
            key = match.group(1).strip()
            value = match.group(2)
            index.setdefault(key, []).append((path, i, value))
    return index


def scan_source_dir(source_dir: Optional[Path]) -> Dict[str, List[Path]]:
    if source_dir is None or not source_dir.exists():
        return {}
    index: Dict[str, List[Path]] = {}
    for path in sorted(source_dir.glob("*.lang")):
        for line in read_text(path).splitlines():
            match = LANG_LINE_RE.match(line)
            if not match:
                continue
            key = match.group(1).strip()
            index.setdefault(key, []).append(path)
    return index


def replace_key(path: Path, key: str, value: str) -> Tuple[bool, str]:
    lines = read_text(path).splitlines()
    old_value = ""
    changed = False
    for i, line in enumerate(lines):
        match = LANG_LINE_RE.match(line)
        if match and match.group(1).strip() == key:
            old_value = match.group(2)
            if old_value != value:
                lines[i] = f"{key}={value}"
                changed = True
            break
    if changed:
        write_text(path, "\n".join(lines) + "\n")
    return changed, old_value


def append_key(path: Path, key: str, value: str, section_label: str) -> None:
    today = datetime.now().strftime("%Y-%m-%d")
    if path.exists():
        text = read_text(path)
        if text and not text.endswith("\n"):
            text += "\n"
        if section_label not in text:
            text += f"\n# {section_label} - {today}\n"
        text += f"{key}={value}\n"
    else:
        text = (
            "# Dolibarr Bahasa Melayu Malaysia\n"
            f"# Generated by Excel Translation Import - {today}\n"
            "# Encoding: UTF-8\n\n"
            f"{key}={value}\n"
        )
    write_text(path, text)


def choose_target_file(key: str, source_index: Dict[str, List[Path]], target_dir: Path) -> Optional[Path]:
    source_paths = source_index.get(key, [])
    if not source_paths:
        return None
    return target_dir / source_paths[0].name


def write_report(report_dir: Path, report_rows: List[Dict[str, str]]) -> Path:
    report_dir.mkdir(parents=True, exist_ok=True)
    stamp = datetime.now().strftime("%Y%m%d-%H%M%S")
    report_path = report_dir / f"import-excel-translations-{stamp}.csv"
    with report_path.open("w", encoding="utf-8-sig", newline="") as f:
        writer = csv.DictWriter(f, fieldnames=["key", "value", "status", "file", "old_value", "note"])
        writer.writeheader()
        writer.writerows(report_rows)
    return report_path


def process(args: argparse.Namespace) -> Tuple[List[Dict[str, str]], int]:
    excel_rows = read_excel_rows(
        args.excel,
        args.key_col,
        args.value_col,
        args.sheet,
        args.start_row,
        args.skip_header,
    )
    target_index = scan_lang_dir(args.target_dir)
    source_index = scan_source_dir(args.source_dir)

    seen: set[str] = set()
    report: List[Dict[str, str]] = []
    changes = 0

    for row_number, key, value in excel_rows:
        base = {"key": key, "value": value, "file": "", "old_value": "", "note": f"Excel row {row_number}"}

        if not key:
            report.append({**base, "status": "skipped_empty_key"})
            continue
        if not value:
            report.append({**base, "status": "skipped_empty_value"})
            continue
        if key in seen and args.duplicate_policy == "skip":
            report.append({**base, "status": "duplicate_input"})
            continue
        seen.add(key)

        occurrences = target_index.get(key, [])
        if occurrences:
            targets = occurrences if args.update_policy == "all" else occurrences[:1]
            for path, _line_index, old_value in targets:
                row = {**base, "file": str(path), "old_value": old_value}
                if old_value == value:
                    report.append({**row, "status": "skipped_same_value"})
                elif args.mode == "apply":
                    changed, previous = replace_key(path, key, value)
                    report.append({**row, "status": "updated" if changed else "skipped_same_value", "old_value": previous})
                    changes += 1 if changed else 0
                else:
                    report.append({**row, "status": "would_update"})
            continue

        target_file = choose_target_file(key, source_index, args.target_dir)
        if target_file is None and args.allow_unmapped_to_fallback:
            target_file = args.target_dir / args.fallback_file
        if target_file is None:
            report.append({**base, "status": "skipped_unmapped", "note": "Key not found in target .lang or source en_US .lang"})
            continue

        if args.mode == "apply":
            append_key(target_file, key, value, args.section_label)
            target_index.setdefault(key, []).append((target_file, -1, value))
            report.append({**base, "status": "added", "file": str(target_file)})
            changes += 1
        else:
            report.append({**base, "status": "would_add", "file": str(target_file)})

    return report, changes


def print_summary(report: List[Dict[str, str]], changes: int, report_path: Path, mode: str) -> None:
    counts: Dict[str, int] = {}
    for row in report:
        status = row["status"]
        counts[status] = counts.get(status, 0) + 1

    print(f"Mode: {mode}")
    print(f"Rows processed: {len(report)}")
    print(f"Changes applied: {changes}")
    for status in sorted(counts):
        print(f"{status}: {counts[status]}")
    print(f"Report: {report_path}")


def build_parser() -> argparse.ArgumentParser:
    parser = argparse.ArgumentParser(description="Import Excel translation rows into Dolibarr ms_MY .lang files.")
    parser.add_argument("--excel", required=True, type=Path, help="Path to .xlsx file with Key and Translation columns.")
    parser.add_argument("--target-dir", required=True, type=Path, help="Target lang/ms_MY directory.")
    parser.add_argument("--source-dir", type=Path, default=None, help="Optional Dolibarr en_US language directory for module key discovery.")
    parser.add_argument("--report-dir", type=Path, default=Path("reports"), help="Directory for CSV import reports.")
    parser.add_argument("--sheet", default=None, help="Optional Excel sheet name. Defaults to first sheet.")
    parser.add_argument("--key-col", default="A", help="Excel key column. Default: A")
    parser.add_argument("--value-col", default="B", help="Excel value column. Default: B")
    parser.add_argument("--start-row", type=int, default=1, help="First Excel row to read. Default: 1")
    parser.add_argument("--skip-header", action="store_true", help="Skip the first row after --start-row.")
    parser.add_argument("--mode", choices=["dry-run", "apply"], default="dry-run", help="dry-run previews; apply writes .lang files.")
    parser.add_argument("--update-policy", choices=["first", "all"], default="all", help="Update first or all duplicate target keys. Default: all")
    parser.add_argument("--duplicate-policy", choices=["skip", "process"], default="skip", help="Handle duplicate Excel keys. Default: skip")
    parser.add_argument("--allow-unmapped-to-fallback", action="store_true", help="Append unmapped keys to fallback file instead of skipping.")
    parser.add_argument("--fallback-file", default="main.lang", help="Fallback file. Default: main.lang")
    parser.add_argument("--section-label", default="Excel Translation Import", help="Comment heading used when appending new keys.")
    return parser


def main() -> int:
    parser = build_parser()
    args = parser.parse_args()

    if not args.excel.exists():
        parser.error(f"Excel file not found: {args.excel}")
    if not args.target_dir.exists():
        parser.error(f"Target directory not found: {args.target_dir}")
    if args.source_dir is not None and not args.source_dir.exists():
        print(f"Warning: source directory not found: {args.source_dir}. Source mapping disabled.", file=sys.stderr)
        args.source_dir = None

    report, changes = process(args)
    report_path = write_report(args.report_dir, report)
    print_summary(report, changes, report_path, args.mode)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
