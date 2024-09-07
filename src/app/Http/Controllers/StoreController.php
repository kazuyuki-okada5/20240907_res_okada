<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Store;
use App\Models\Favorite; // Favoriteモデルを使用する場合
use App\Models\Editor;
use Illuminate\Support\Facades\Auth;
use App\Models\UserStore; // 必要に応じて追加する
use App\Models\User; // Userモデルをインポートする
use Illuminate\Support\Facades\DB;
use App\Models\Review;



class StoreController extends Controller
{
public function show($id)
{
    // 引数で受け取ったIDに対応するストアを取得
    $store = Store::findOrFail($id);

    // 該当するストアの口コミを取得
    $review = Review::where('store_id', $store->id)->latest()->first();

    // 取得したストアと口コミを詳細ページに渡して表示する
    return view('store_detail', [
        'store' => $store,
        'review' => $review,
    ]);
}

    public function index(Request $request)
    {
        $selectedAreaId = $request->input('area_id', '');  
        $selectedGenreId = $request->input('genre_id', '');  

        $userFavoriteStores = auth()->check() ? auth()->user()->favorites->pluck('store_id')->toArray() : [];
        $userFavoriteStoresJson = json_encode($userFavoriteStores); 

        $query = Store::query()->with(['area', 'genre']);

        // エリアとジャンルのフィルタリング
        if ($selectedAreaId) {
            $query->where('area_id', $selectedAreaId);
        }

        if ($selectedGenreId) {
            $query->where('genre_id', $selectedGenreId);
        }

        // ソート機能
        if ($request->filled('sort')) {
            switch($request->sort) {
                case 'high_rating':
                    $query->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating');
                    break;
                case 'low_rating':
                    $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating');
                    break;
                case 'random':
                    $query->inRandomOrder();
                    break;
            }
        }

        $stores = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

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

    // storeメソッドの追加
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

        // 店舗情報を新規作成
        $store = Store::create([
            'name' => $request->name,
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'store_overview' => $request->store_overview,
            'image_url' => $request->image_url,
        ]);
        
        // 作成されたストアの詳細ページにリダイレクトする
        return redirect()->route('representative.home')->with('success', 'ストアが作成されました。');
    }

    // editメソッドの追加
    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $user = Auth::user();
        $areas = Area::all(); // エリアのリストを取得
        $genres = Genre::all(); // ジャンルのリストを取得

        // ログイン中のユーザーが店舗代表者であるかを確認する
        if ($user->role === 'representative') {
            // ログイン中の店舗代表者が編集可能な店舗のリストを取得する
            $editableStores = $user->stores->pluck('id')->toArray();

            // ユーザーが編集しようとしている店舗が編集可能な店舗リストに含まれているかを確認する
            if (in_array($store->id, $editableStores)) {
                // ユーザーが編集可能な店舗である場合は編集ページを表示する
                return view('representative.edit', compact('store', 'areas', 'genres'));
            } else {
                // 編集できない店舗である場合は適切な処理を行う（例: リダイレクト、エラーメッセージの表示など）
                return redirect()->route('home')->with('error', '編集する権限がありません。');
            }
        } else {
            // 店舗代表者でない場合は適切な処理を行う（例: リダイレクト、エラーメッセージの表示など）
            return redirect()->route('home')->with('error', '店舗代表者でないため、編集する権限がありません。');
        }
    }


// 代表者用のホーム画面を表示するメソッド
    public function representativeHome()
    {
        // 1. ログイン状態を確認する
        if (auth()->check()) {
            // 2. ログインユーザーのIDを取得する
            $userId = auth()->id();

            // 3. ユーザーIDを使用して関連付けられた店舗を取得する
            $userStores = UserStore::where('user_id', $userId)->with('store')->get();
// 4. エリアのデータを取得
        $areas = Area::all();
        $genres = Genre::all();

        // 5. 取得された店舗とエリアを表示する
        return view('representative.home', ['userStores' => $userStores, 'areas' => $areas, 'genres' => $genres]);
    } else {
            // ログインしていない場合は何らかの処理を行う（例えばリダイレクト）
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }
    }
    public function update(Request $request, $id)
{
    // バリデーションルールを定義
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'area_id' => 'required|integer',
        'genre_id' => 'required|integer',
        'store_overview' => 'required|string',
        'image_url' => 'required|string|max:255',
    ]);

    // 更新対象の店舗を取得
    $store = Store::findOrFail($id);

    // 店舗情報を更新
    $store->update([
        'name' => $request->name,
        'area_id' => $request->area_id,
        'genre_id' => $request->genre_id,
        'store_overview' => $request->store_overview,
        'image_url' => $request->image_url,
    ]);

    // 更新後に店舗詳細ページにリダイレクト
   return redirect()->route('representative.home')->with('success', 'ストアが更新されました。');
}

public function attachRepresentative(Request $request)
    {
        // フォームから送信されたデータを受け取る
        $representativeId = $request->input('representative_id');
        $storeId = $request->input('store_id');

        // 代表者と店舗のIDを使用して、user_storeテーブルに新しいレコードを挿入
        DB::table('user_store')->insert([
            'user_id' => $representativeId,
            'store_id' => $storeId
        ]);

        // 成功した場合はリダイレクトまたは適切なレスポンスを返す
        return redirect()->back()->with('success', '関連付けが成功しました。');
    }
}
