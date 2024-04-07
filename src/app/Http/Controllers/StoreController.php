<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Store;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('index', compact('stores'));
    }

    public function search(Request $request)
    {
        $areaID = $request->input('area_id');
        $stores = Store::where('area_id', $areaId)->get();
        return view('index', compact('stores'));
    }

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

     public function storesByArea(Area $area)
    {
        $stores = $area->stores;
        return view('stores.index', compact('stores'));
    }
}