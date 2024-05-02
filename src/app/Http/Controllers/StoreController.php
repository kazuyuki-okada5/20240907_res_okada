<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Store;
use App\Models\Favorite; // Favoriteモデルを使用する場合
use App\Models\Editor;

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

    public function destroy(Store $store)
    {
        // ストアを削除するロジックをここに追加
    }

    public function storesByArea(Area $area)
    {
        $stores = $area->stores;
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        // 代表者の場合
        return view('store.create');
    }

public function store(Request $request)
{
    // バリデーションルールを定義
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'area_id' => 'required|integer',
        'genre_id' => 'required|integer',
        'store_overview' => 'required|string',
        'image_url' => 'required|string|max:255',
    ]);

    // データベースに新しいレコードを作成
    $store = Store::create($validatedData);

    // リダイレクトまたはビューを返す
    // 例: 作成されたストアの詳細ページにリダイレクトする
    return redirect()->route('stores.show', $store->id);
}

    public function edit(Store $store)
    {
        // 代表者またはエディターの場合の処理
        return view('store.edit',compact('store'));
    }


 public function update(Request $request, $id)
{
    // リクエストデータの検証
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'area_id' => 'required|exists:areas,id',
        'genre_id' => 'required|exists:genres,id',
        'store_overview' => 'required|string',
        'image_url' => 'required|string|max:255',
    ]);

    // ログ出力: 対象のストアを検索する前にIDを確認
    \Log::info('Updating store with ID: ' . $id);

    // 対象のストアを取得して更新
    $store = Store::findOrFail($id);
    $store->update($validatedData);

    // ログ出力: 更新されたストアの内容を確認
    \Log::info('Updated store: ' . $store);

    // 更新後にリダイレクトするページを検討
    return redirect()->route('update.complete');
}
}
