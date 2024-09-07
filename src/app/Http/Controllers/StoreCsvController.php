<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StoresImport;
use App\Exports\StoresExport;
use Maatwebsite\Excel\Facades\Excel;

class StoreCsvController extends Controller
{
    // インポート機能
public function import(Request $request)
{
    // CSVファイルのバリデーション
    $request->validate([
        'file' => 'required|mimes:csv,txt', // ファイルのMIMEタイプを確認
    ]);

    try {
        // アップロードされたファイルを取得
        $file = $request->file('file');

        // ファイルの内容を文字列として読み取る
        $contents = file_get_contents($file->getRealPath());

        // ファイル内容をダンプして確認
        // dd($contents);

        // ファイルをインポート
        Excel::import(new StoresImport, $file);

        // 成功メッセージと共にリダイレクト
        return redirect()->back()->with('success', '店舗情報が正常にインポートされました。');
    } catch (\Exception $e) {
        // エラーメッセージと共にリダイレクト
        return redirect()->back()->with('error', 'インポート中にエラーが発生しました: ' . $e->getMessage());
    }
}


    // エクスポート機能
    public function export()
    {
        // stores.xlsx という名前でエクスポート
        return Excel::download(new StoresExport, 'stores.xlsx');
    }
}

