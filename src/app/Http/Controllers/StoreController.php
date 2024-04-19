<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Store;
use App\Models\Favorite; // Favoriteモデルを使用する場合

class StoreController extends Controller
{
    public function show($id)
    {
        // 引数で受け取ったIDに対応するストアを取得
        $store = Store::findOrFail($id);

        // 取得したストアを詳細ページに渡して表示する
        return view('store_detail', ['store' => $store]);
    }

    public function index(Request $request)
{
    $selectedAreaId = $request->input('area_id', '');  
    $selectedGenreId = $request->input('genre_id', '');  

    $userFavoriteStores = auth()->check() ? auth()->user()->favorites->pluck('store_id')->toArray() : [];
    $userFavoriteStoresJson = json_encode($userFavoriteStores); 

    $stores = Store::with(['area', 'genre'])->get();
    $areas = \App\Models\Area::all();  
    $genres = \App\Models\Genre::all();  
    
    return view('index', compact('stores', 'areas', 'selectedAreaId', 'selectedGenreId', 'userFavoriteStores', 'genres', 'userFavoriteStoresJson')); 
}


public function search(Request $request)
{
    $areaId = $request->input('area_id');
    $genreId = $request->input('genre_id');
    $keyword = $request->input('keyword');

    $query = Store::query();

    if ($areaId) {
        $query->where('area_id', $areaId);
    }

    if ($genreId) {
        $query->where('genre_id', $genreId);
    }

    if ($keyword) {
        $query->where(function ($q) use ($keyword){
            $q->where('name', 'like', '%' . $keyword . '%')
              ->orWhere('store_overview', 'like', '%' . $keyword . '%');
        });
    }

    $stores = $query->with(['area', 'genre'])->get(); 

    $areas = \App\Models\Area::all(); 
    $genres = \App\Models\Genre::all(); 
    
    $selectedAreaId = $areaId;
    $selectedGenreId = $genreId;
    $keywordValue = $keyword;
    
     $userFavoriteStores = auth()->check() ? auth()->user()->favorites->pluck('store_id')->toArray() : [];
    $userFavoriteStoresJson = json_encode($userFavoriteStores); 

    // ここでユーザーのお気に入り情報をビューに渡す
    return view('index', compact('stores', 'areas', 'selectedAreaId', 'genres', 'selectedGenreId', 'keywordValue', 'userFavoriteStores', 'userFavoriteStoresJson')); 
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