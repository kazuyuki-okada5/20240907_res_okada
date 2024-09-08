<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StoresImport;
use Maatwebsite\Excel\Facades\Excel;

class StoreCsvController extends Controller
{
public function import(Request $request)
{
    // CSVファイルのバリデーション
    $request->validate([
        'file' => 'required|mimes:csv,txt', // ファイルのMIMEタイプを確認
    ]);

    try {
        // アップロードされたファイルを取得
        $file = $request->file('file');

        // ファイルをインポート
        Excel::import(new StoresImport, $file);

        // 成功メッセージと共にリダイレクト
        return redirect()->back()->with('success', '店舗情報が正常にインポートされました。');
    } catch (\Exception $e) {
        // エラーメッセージと共にリダイレクト
        return redirect()->back()->with('error', 'インポート中にエラーが発生しました: ' . $e->getMessage());
    }
}
}

