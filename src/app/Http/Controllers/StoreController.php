<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;

class StoreController extends Controller
{
    public function show()
    {
        return view('store_detail');
    }

    public function store(Request $request)
    {
        // ストアを追加するロジックをここに記述
    }

    public function destroy(Store $store)
    {
        // ストアを削除するロジックをここに追加
    }

    public function index()
    {
        $shops = Store::with('area', 'genre')->get();
        return view('stores.index', compact('shops'));
    }

     public function storesByArea(Area $area)
    {
        $stores = $area->stores;
        return view('stores.index', compact('stores'));
    }
}