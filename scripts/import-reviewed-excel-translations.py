#!/usr/bin/env python3
"""
Import only reviewed rows from a prepared translation workbook into Dolibarr .lang files.

Expected workbook columns:
  A Key
  B SourceEnglish
  C CurrentMalay
  D ProposedMalay
  E TargetFile
  F Action
  G Status
  H Note

Default safety rules:
  - Only rows with Status=ready are processed.
  - Existing ms_MY keys are not overwritten.
  - Rows with blank ProposedMalay are skipped.
  - Every run generates a CSV report.

This script is dependency-free and uses only the Python standard library.
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
    value = 0
    for ch in col:
        value = value * 26 + (ord(ch) - 64)
    return value - 1


def normalise_value(value: str) -> str:
    return value.replace("\r\n", "\\n").replace("\n", "\\n").replace("\r", "\\n").strip()


def xml_text(node: ET.Element) -> str:
    return "".join(node.itertext())


def read_shared_strings(zf: zipfile.ZipFile) -> List[str]:
    try:
        root = ET.fromstring(zf.read("xl/sharedStrings.xml"))
    except KeyError:
        return []
    return [xml_text(si) for si in root.findall("main:si", NS)]


def get_sheet_path(zf: zipfile.ZipFile, sheet_name: Optional[str]) -> str:
    workbook = ET.fromstring(zf.read("xl/workbook.xml"))
    rels = ET.fromstring(zf.read("xl/_rels/workbook.xml.rels"))
    rel_map = {rel.attrib.get("Id"): rel.attrib.get("Target", "") for rel in rels.findall("pkgrel:Relationship", NS)}
    sheets = workbook.findall("main:sheets/main:sheet", NS)
    if not sheets:
        raise ValueError("Workbook has no sheets")
    selected = sheets[0]
    if sheet_name:
        matches = [sheet for sheet in sheets if sheet.attrib.get("name") == sheet_name]
        if not matches:
            available = ", ".join(sheet.attrib.get("name", "") for sheet in sheets)
            raise ValueError(f"Sheet {sheet_name!r} not found. Available sheets: {available}")
        selected = matches[0]
    rid = selected.attrib.get(f"{{{NS['rel']}}}id")
    target = rel_map.get(rid)
    if not target:
        raise ValueError("Unable to resolve sheet relationship")
    if target.startswith("/"):
        return target.lstrip("/")
    if target.startswith("xl/"):
        return target
    return "xl/" + target


def read_workbook_rows(excel_path: Path, sheet_name: Optional[str], start_row: int, skip_header: bool) -> List[Tuple[int, Dict[str, str]]]:
    headers = ["key", "source_english", "current_malay", "proposed_malay", "target_file", "action", "status", "note"]
    first_data_row = start_row + (1 if skip_header else 0)
    output: List[Tuple[int, Dict[str, str]]] = []

    with zipfile.ZipFile(excel_path) as zf:
        shared = read_shared_strings(zf)
        root = ET.fromstring(zf.read(get_sheet_path(zf, sheet_name)))
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
                    value = shared[int(raw)] if raw else ""
                elif cell_type == "inlineStr":
                    inline = cell.find("main:is", NS)
                    value = xml_text(inline) if inline is not None else ""
                else:
                    value = cell.findtext("main:v", default="", namespaces=NS)
                cells[col_index] = value
            data = {name: normalise_value(str(cells.get(i, ""))) for i, name in enumerate(headers)}
            if any(data.values()):
                output.append((row_number, data))
    return output


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
            if match:
                index.setdefault(match.group(1).strip(), []).append((path, i, match.group(2)))
    return index


def resolve_target_file(raw: str, target_dir: Path) -> Optional[Path]:
    if not raw:
        return None
    first = raw.split("|")[0].strip()
    path = Path(first)
    if path.is_absolute():
        return path
    if path.name.endswith(".lang") and path.parent == Path("."):
        return target_dir / path.name
    return path


def append_key(path: Path, key: str, value: str, section_label: str) -> None:
    today = datetime.now().strftime("%Y-%m-%d")
    if path.exists():
        text = read_text(path)
        if text and not text.endswith("\n"):
            text += "\n"
        heading = f"# {section_label} - {today}"
        if heading not in text:
            text += f"\n{heading}\n"
        text += f"{key}={value}\n"
    else:
        text = (
            "# Dolibarr Bahasa Melayu Malaysia\n"
            f"# Generated by Reviewed Excel Translation Import - {today}\n"
            "# Encoding: UTF-8\n\n"
            f"{key}={value}\n"
        )
    write_text(path, text)


def replace_key(path: Path, key: str, value: str) -> Tuple[bool, str]:
    lines = read_text(path).splitlines()
    previous = ""
    changed = False
    for i, line in enumerate(lines):
        match = LANG_LINE_RE.match(line)
        if match and match.group(1).strip() == key:
            previous = match.group(2)
            if previous != value:
                lines[i] = f"{key}={value}"
                changed = True
            break
    if changed:
        write_text(path, "\n".join(lines) + "\n")
    return changed, previous


def write_report(report_dir: Path, rows: List[Dict[str, str]]) -> Path:
    report_dir.mkdir(parents=True, exist_ok=True)
    stamp = datetime.now().strftime("%Y%m%d-%H%M%S")
    report_path = report_dir / f"import-reviewed-excel-translations-{stamp}.csv"
    with report_path.open("w", encoding="utf-8-sig", newline="") as f:
        writer = csv.DictWriter(f, fieldnames=["row", "key", "source_english", "proposed_malay", "status", "action", "file", "old_value", "note"])
        writer.writeheader()
        writer.writerows(rows)
    return report_path


def process(args: argparse.Namespace) -> Tuple[List[Dict[str, str]], int]:
    rows = read_workbook_rows(args.excel, args.sheet, args.start_row, args.skip_header)
    target_index = scan_lang_dir(args.target_dir)
    allowed_status = {item.strip().lower() for item in args.only_status.split(",") if item.strip()}
    report: List[Dict[str, str]] = []
    changes = 0

    for row_number, data in rows:
        key = data["key"]
        proposed = data["proposed_malay"]
        status = data["status"].lower()
        action = data["action"].lower()
        target_file = resolve_target_file(data["target_file"], args.target_dir)
        base = {
            "row": str(row_number),
            "key": key,
            "source_english": data["source_english"],
            "proposed_malay": proposed,
            "action": action,
            "file": str(target_file or ""),
            "old_value": "",
            "note": data["note"],
        }

        if row_number == args.start_row and key.lower() == "key":
            report.append({**base, "status": "skipped_header"})
            continue
        if not key:
            report.append({**base, "status": "skipped_empty_key"})
            continue
        if status not in allowed_status:
            report.append({**base, "status": "skipped_status"})
            continue
        if not proposed:
            report.append({**base, "status": "skipped_empty_proposed_malay"})
            continue
        if action not in {"add", "update_reviewed"}:
            report.append({**base, "status": "skipped_action"})
            continue
        if target_file is None:
            report.append({**base, "status": "skipped_no_target_file"})
            continue

        occurrences = target_index.get(key, [])
        if occurrences and not args.allow_update_existing:
            old_values = " | ".join(sorted({value for _path, _line, value in occurrences}))
            files = " | ".join(sorted({str(path) for path, _line, _value in occurrences}))
            report.append({**base, "status": "skipped_existing_protected", "file": files, "old_value": old_values})
            continue

        if occurrences and args.allow_update_existing:
            changed_any = False
            for path, _line, old_value in occurrences:
                if args.mode == "apply":
                    changed, previous = replace_key(path, key, proposed)
                    changed_any = changed_any or changed
                    report.append({**base, "status": "updated" if changed else "skipped_same_value", "file": str(path), "old_value": previous})
                else:
                    report.append({**base, "status": "would_update", "file": str(path), "old_value": old_value})
            changes += 1 if changed_any and args.mode == "apply" else 0
            continue

        if args.mode == "apply":
            append_key(target_file, key, proposed, args.section_label)
            target_index.setdefault(key, []).append((target_file, -1, proposed))
            report.append({**base, "status": "added"})
            changes += 1
        else:
            report.append({**base, "status": "would_add"})

    return report, changes


def print_summary(report: List[Dict[str, str]], changes: int, report_path: Path, mode: str) -> None:
    counts: Dict[str, int] = {}
    for row in report:
        counts[row["status"]] = counts.get(row["status"], 0) + 1
    print(f"Mode: {mode}")
    print(f"Rows processed: {len(report)}")
    print(f"Changes applied: {changes}")
    for status in sorted(counts):
        print(f"{status}: {counts[status]}")
    print(f"Report: {report_path}")


def build_parser() -> argparse.ArgumentParser:
    parser = argparse.ArgumentParser(description="Import reviewed Excel rows into Dolibarr ms_MY .lang files.")
    parser.add_argument("--excel", required=True, type=Path, help="Reviewed workbook path.")
    parser.add_argument("--target-dir", required=True, type=Path, help="Target lang/ms_MY directory.")
    parser.add_argument("--report-dir", type=Path, default=Path("reports"), help="Report directory.")
    parser.add_argument("--sheet", default=None, help="Optional sheet name. Defaults to first sheet.")
    parser.add_argument("--start-row", type=int, default=1, help="First row to read. Default: 1")
    parser.add_argument("--skip-header", action="store_true", help="Skip the first row after --start-row.")
    parser.add_argument("--only-status", default="ready", help="Comma-separated statuses allowed for import. Default: ready")
    parser.add_argument("--mode", choices=["dry-run", "apply"], default="dry-run", help="dry-run previews; apply writes .lang files.")
    parser.add_argument("--allow-update-existing", action="store_true", help="Allow update_reviewed rows to overwrite existing keys. Default protects existing ms_MY translations.")
    parser.add_argument("--section-label", default="Reviewed Excel Translation Import", help="Comment heading when appending keys.")
    return parser


def main() -> int:
    parser = build_parser()
    args = parser.parse_args()
    if not args.excel.exists():
        parser.error(f"Excel file not found: {args.excel}")
    if not args.target_dir.exists():
        parser.error(f"Target directory not found: {args.target_dir}")

    report, changes = process(args)
    report_path = write_report(args.report_dir, report)
    print_summary(report, changes, report_path, args.mode)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
