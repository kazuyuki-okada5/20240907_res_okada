<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StoresImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Store;

class StoreCsvController extends Controller
{
// csvインポート
public function import(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:csv,txt',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $file = $request->file('file');

        Excel::import(new StoresImport, $file);

            return redirect()->back()->with('success', '店舗情報が正常にインポートされました。');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->with('error', 'インポート中にバリデーションエラーが発生しました。')
                ->with('errorDetails', $e->errors());
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'インポート中にエラーが発生しました。')
                ->with('errorDetails', 'エラーの詳細: ' . $e->getMessage());
        }
    }
}

