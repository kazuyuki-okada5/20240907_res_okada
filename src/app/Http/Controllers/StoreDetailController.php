<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StoreDetailController;
use App\Models\Store;

class StoreDetailController extends Controller
{
public function index()
{


    // ビューに時間の選択肢を渡す
    return view('store_detail', ['times' => $times]);
    }
    public function show($id)
    {
        // 店舗の詳細情報を取得してビューに渡す
        $store = Store::findOrFail($id);
        return view('store_detail', compact('store'));
    }
}
