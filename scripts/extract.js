/**
 * extract.js — HTMLファイルからプロンプトのメタデータを抽出し、JSONを生成する
 *
 * 使い方:
 *   node scripts/extract.js > data/prompts.json
 *
 * 処理内容:
 *   リポジトリ直下の全 .html ファイルを読み込み、各ファイルから
 *   タイトル・目的・セクション構成などを正規表現で抽出して
 *   JSON 配列として標準出力に書き出す。
 *
 * 除外ルール:
 *   - リポジトリ直下の .html ファイルのみを対象とする
 *   - サブフォルダ内のファイルは自動的に対象外となる
 *     （例: private/ フォルダにファイルを移動すれば一覧から除外される）
 *   - EXCLUDE に指定したファイル名も除外される
 *
 * 既存の HTML ファイルには一切変更を加えない（読み取り専用）。
 */

const fs = require("fs");
const path = require("path");

// リポジトリルート（このスクリプトの1階層上）
const ROOT = path.resolve(__dirname, "..");

// 除外ファイル
const EXCLUDE = new Set(["test.html"]);

// ── ファイル一覧を取得しソート ──────────────────────────────────
const files = fs
  .readdirSync(ROOT)
  .filter((f) => f.endsWith(".html") && !EXCLUDE.has(f))
  .sort((a, b) => {
    // プレフィックス（S, d, demo 等）でまず分類し、番号順にソート
    const prefA = a.replace(/[0-9().html_OLD]/g, "");
    const prefB = b.replace(/[0-9().html_OLD]/g, "");
    if (prefA !== prefB) return prefA.localeCompare(prefB);
    const numA = parseInt(a.replace(/[^0-9]/g, "")) || 0;
    const numB = parseInt(b.replace(/[^0-9]/g, "")) || 0;
    return numA - numB;
  });

// ── 各 HTML からメタデータを抽出 ────────────────────────────────
const prompts = [];

for (const file of files) {
  const html = fs.readFileSync(path.join(ROOT, file), "utf-8");

  // タイトル: .box-title > .title-text > <title> の優先順で取得
  const boxTitleMatch =
    html.match(/class="box-title"[^>]*>(.*?)<\/div>/s) ||
    html.match(/class="title-text">(.*?)<\/span>/s);
  const titleTagMatch = html.match(/<title>(.*?)<\/title>/s);
  const rawTitle = (
    boxTitleMatch
      ? boxTitleMatch[1]
      : titleTagMatch
        ? titleTagMatch[1]
        : ""
  ).trim();
  const fullTitle = rawTitle
    .replace(/<[^>]*>/g, "")  // HTMLタグ除去
    .replace(/[☰×▼▲]/g, "")  // トグルアイコン文字を除去
    .replace(/\s+/g, " ")     // 連続空白を正規化
    .trim();

  // ID: タイトル先頭の番号、またはファイル名から
  const idMatch =
    fullTitle.match(/^#?(\d+|S\d+|d\d+)/i) ||
    file.match(/^(\d+|S\d+|d\d+)/i);
  const id = idMatch ? idMatch[1] : file.replace(".html", "");

  // タイトル（番号プレフィックスを除去した本文部分）
  const title = fullTitle
    .replace(/^#?\d+[_\s]*/, "")
    .replace(/^S\d+[_\s]*/, "");

  // 目的・ねらい: h2直後の div 内テキストを取得（先頭200文字）
  const purposeMatch = html.match(/目的・ねらい<\/h2>\s*([\s\S]*?)<\/div>/);
  const purpose = purposeMatch
    ? purposeMatch[1]
        .replace(/<br\s*\/?>/gi, "\n")
        .replace(/<[^>]*>/g, "")
        .trim()
        .substring(0, 200)
    : "";

  // セクション構成: 全 h2 タグを収集
  const sections = [...html.matchAll(/<h2>(.*?)<\/h2>/g)].map((m) =>
    m[1].trim()
  );

  // ユーザー入力欄の数: .variable-textarea クラスの出現回数
  const userInputCount = (html.match(/variable-textarea/g) || []).length;

  // 旧バージョン判定: ファイル名に OLD を含む
  const isOld = /OLD/i.test(file);

  prompts.push({ id, file, title, purpose, sections, userInputCount, isOld });
}

// ── 出力 ────────────────────────────────────────────────────────
console.log(JSON.stringify(prompts, null, 2));
console.error(`${prompts.length} 件のHTMLファイルを処理しました`);
