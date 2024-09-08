<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StoresImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Store;

class StoreCsvController extends Controller
{
public function import(Request $request)
{
    // CSVファイルのバリデーション
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:csv,txt',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        // アップロードされたファイルを取得
        $file = $request->file('file');

        // ファイルをインポート
        Excel::import(new StoresImport, $file);

            // 成功メッセージと共にリダイレクト
            return redirect()->back()->with('success', '店舗情報が正常にインポートされました。');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // バリデーションエラーの詳細をセッションに保存
            return redirect()->back()
                ->with('error', 'インポート中にバリデーションエラーが発生しました。')
                ->with('errorDetails', $e->errors());
        } catch (\Exception $e) {
            // 一般的なエラーの詳細をセッションに保存
            return redirect()->back()
                ->with('error', 'インポート中にエラーが発生しました。')
                ->with('errorDetails', 'エラーの詳細: ' . $e->getMessage());
        }
    }
}

