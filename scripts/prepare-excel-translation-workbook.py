#!/usr/bin/env python3
"""
Prepare a reviewed Excel translation workbook for Dolibarr Bahasa Melayu Malaysia.

Input workbook:
  Column A = Dolibarr language key
  Column B = English/source text

Output workbook columns:
  Key, SourceEnglish, CurrentMalay, ProposedMalay, TargetFile, Action, Status, Note

This script is dependency-free. It reads and writes .xlsx files using only the
Python standard library so it can run on a clean Windows/XAMPP workstation.
"""
from __future__ import annotations

import argparse
import html
import re
import sys
import zipfile
from datetime import datetime, timezone
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
HEADERS = ["Key", "SourceEnglish", "CurrentMalay", "ProposedMalay", "TargetFile", "Action", "Status", "Note"]


def col_to_index(col: str) -> int:
    col = col.strip().upper()
    if not re.fullmatch(r"[A-Z]+", col):
        raise ValueError(f"Invalid Excel column: {col!r}")
    value = 0
    for ch in col:
        value = value * 26 + (ord(ch) - 64)
    return value - 1


def index_to_col(index: int) -> str:
    index += 1
    out = ""
    while index:
        index, rem = divmod(index - 1, 26)
        out = chr(65 + rem) + out
    return out


def xml_text(node: ET.Element) -> str:
    return "".join(node.itertext())


def normalise_value(value: str) -> str:
    return value.replace("\r\n", "\\n").replace("\n", "\\n").replace("\r", "\\n").strip()


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


def read_excel_rows(excel_path: Path, key_col: str, value_col: str, sheet_name: Optional[str], start_row: int, skip_header: bool) -> List[Tuple[int, str, str]]:
    key_index = col_to_index(key_col)
    value_index = col_to_index(value_col)
    first_data_row = start_row + (1 if skip_header else 0)
    rows: List[Tuple[int, str, str]] = []

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
            key = str(cells.get(key_index, "")).strip()
            value = normalise_value(str(cells.get(value_index, "")))
            if key or value:
                rows.append((row_number, key, value))
    return rows


def read_text(path: Path) -> str:
    return path.read_text(encoding="utf-8-sig")


def scan_lang_values(lang_dir: Path) -> Dict[str, List[Tuple[Path, str]]]:
    index: Dict[str, List[Tuple[Path, str]]] = {}
    if not lang_dir.exists():
        return index
    for path in sorted(lang_dir.glob("*.lang")):
        for line in read_text(path).splitlines():
            match = LANG_LINE_RE.match(line)
            if match:
                index.setdefault(match.group(1).strip(), []).append((path, match.group(2)))
    return index


def scan_source_files(source_dir: Optional[Path]) -> Dict[str, List[Path]]:
    if source_dir is None or not source_dir.exists():
        return {}
    index: Dict[str, List[Path]] = {}
    for path in sorted(source_dir.glob("*.lang")):
        for line in read_text(path).splitlines():
            match = LANG_LINE_RE.match(line)
            if match:
                index.setdefault(match.group(1).strip(), []).append(path)
    return index


def choose_target_file(key: str, source_index: Dict[str, List[Path]], target_dir: Path) -> str:
    source_paths = source_index.get(key, [])
    return str(target_dir / source_paths[0].name) if source_paths else ""


def build_review_rows(args: argparse.Namespace) -> List[List[str]]:
    input_rows = read_excel_rows(args.excel, args.key_col, args.value_col, args.sheet, args.start_row, args.skip_header)
    target_index = scan_lang_values(args.target_dir)
    source_index = scan_source_files(args.source_dir)
    rows: List[List[str]] = [HEADERS]
    seen: set[str] = set()

    for row_number, key, source_english in input_rows:
        if not key:
            rows.append(["", source_english, "", "", "", "skip", "empty_key", f"Input row {row_number}"])
            continue
        if key in seen:
            rows.append([key, source_english, "", "", "", "skip", "duplicate_input", f"Input row {row_number}"])
            continue
        seen.add(key)

        existing = target_index.get(key, [])
        if existing:
            current_values = sorted({value for _path, value in existing})
            current_files = sorted({str(path) for path, _value in existing})
            current_malay = " | ".join(current_values)
            rows.append([
                key,
                source_english,
                current_malay,
                current_malay,
                " | ".join(current_files),
                "no_change",
                "existing",
                "Already present in ms_MY; do not overwrite mature translation",
            ])
            continue

        target_file = choose_target_file(key, source_index, args.target_dir)
        if target_file:
            rows.append([key, source_english, "", "", target_file, "add", "needs_translation", "Translate ProposedMalay, then set Status=ready"])
        else:
            rows.append([key, source_english, "", "", "", "skip", "unmapped", "Key not found in ms_MY or en_US language files"])
    return rows


def sheet_xml(rows: List[List[str]]) -> str:
    parts = [
        '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>',
        '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">',
        '<sheetViews><sheetView workbookViewId="0"><pane ySplit="1" topLeftCell="A2" activePane="bottomLeft" state="frozen"/></sheetView></sheetViews>',
        '<cols><col min="1" max="1" width="34" customWidth="1"/><col min="2" max="2" width="46" customWidth="1"/><col min="3" max="4" width="42" customWidth="1"/><col min="5" max="5" width="48" customWidth="1"/><col min="6" max="7" width="20" customWidth="1"/><col min="8" max="8" width="58" customWidth="1"/></cols>',
        '<sheetData>',
    ]
    for r_idx, row in enumerate(rows, start=1):
        parts.append(f'<row r="{r_idx}">')
        for c_idx, value in enumerate(row, start=1):
            ref = f"{index_to_col(c_idx - 1)}{r_idx}"
            safe = html.escape(str(value), quote=False)
            parts.append(f'<c r="{ref}" t="inlineStr"><is><t>{safe}</t></is></c>')
        parts.append('</row>')
    parts.extend(['</sheetData>', f'<autoFilter ref="A1:H{len(rows)}"/>', '</worksheet>'])
    return "".join(parts)


def write_xlsx(path: Path, rows: List[List[str]]) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    now = datetime.now(timezone.utc).strftime("%Y-%m-%dT%H:%M:%SZ")
    files = {
        "[Content_Types].xml": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/><Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/><Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/></Types>''',
        "_rels/.rels": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/><Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/></Relationships>''',
        "xl/workbook.xml": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Review" sheetId="1" r:id="rId1"/></sheets></workbook>''',
        "xl/_rels/workbook.xml.rels": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>''',
        "xl/styles.xml": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><fonts count="1"><font><sz val="11"/><name val="Calibri"/></font></fonts><fills count="1"><fill><patternFill patternType="none"/></fill></fills><borders count="1"><border><left/><right/><top/><bottom/><diagonal/></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs><cellXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles></styleSheet>''',
        "xl/worksheets/sheet1.xml": sheet_xml(rows),
        "docProps/core.xml": f'''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:title>Sengiala Language Pack Reviewed Translation Workbook</dc:title><dc:creator>Sengiala Language Pack</dc:creator><cp:lastModifiedBy>Sengiala Language Pack</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">{now}</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">{now}</dcterms:modified></cp:coreProperties>''',
        "docProps/app.xml": '''<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes"><Application>Python</Application></Properties>''',
    }
    with zipfile.ZipFile(path, "w", compression=zipfile.ZIP_DEFLATED) as zf:
        for name, content in files.items():
            zf.writestr(name, content)


def print_summary(rows: List[List[str]], output: Path) -> None:
    counts: Dict[str, int] = {}
    for row in rows[1:]:
        counts[row[6]] = counts.get(row[6], 0) + 1
    print(f"Output: {output}")
    print(f"Rows written: {len(rows) - 1}")
    for status in sorted(counts):
        print(f"{status}: {counts[status]}")


def build_parser() -> argparse.ArgumentParser:
    parser = argparse.ArgumentParser(description="Prepare reviewed Excel workbook before importing Dolibarr Malay translations.")
    parser.add_argument("--excel", required=True, type=Path, help="Input .xlsx with key/source columns.")
    parser.add_argument("--target-dir", required=True, type=Path, help="Current lang/ms_MY directory.")
    parser.add_argument("--source-dir", type=Path, default=None, help="Optional Dolibarr en_US language directory for module key discovery.")
    parser.add_argument("--output", type=Path, default=None, help="Output reviewed .xlsx path.")
    parser.add_argument("--sheet", default=None, help="Optional sheet name. Defaults to first sheet.")
    parser.add_argument("--key-col", default="A", help="Input key column. Default: A")
    parser.add_argument("--value-col", default="B", help="Input English/source text column. Default: B")
    parser.add_argument("--start-row", type=int, default=1, help="First input row to read. Default: 1")
    parser.add_argument("--skip-header", action="store_true", help="Skip the first row after --start-row.")
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
    if args.output is None:
        args.output = Path("reports") / f"translation-workbook-{datetime.now().strftime('%Y%m%d-%H%M%S')}.xlsx"
    rows = build_review_rows(args)
    write_xlsx(args.output, rows)
    print_summary(rows, args.output)
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
