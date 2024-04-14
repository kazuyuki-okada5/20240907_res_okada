<?php

namespace App\Http\Controllers;

use App\Models\Favorite; // 修正
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Reservation;
use App\Models\Area;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggleFavorite($storeId)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('store_id', $storeId)
                            ->first();

        if($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        }else{
            Favorite::create([
                'user_id' => $user->id,
                'store_id' => $storeId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
    public function index()
    {
        // ログインしているユーザーの情報を取得
        $user = Auth::user();

        // ログインしているユーザーのIDを取得
        $userId = $user->id;

        // 予約データを取得
        $reservations = Reservation::where('user_id', $userId)->get();

        // お気に入りの店舗データを取得
        $favoriteStores = $user->favorites;

        // ビューをデータに渡す
        return view('favorite', [
            'reservationDetails' => $reservations,
            'user' => $user, // ユーザー情報をビューに渡す
            'favoriteStores' => $favoriteStores, // お気に入りの店舗データをビューに渡す
        ]);
    }

    public function store(Request $request)
    {
        // お気に入りを追加する処理を実装
    }

    public function destroy(Favorite $favorite)
    {
        // お気に入りを削除する処理を実装
    }

public function favoritesArea(Area $area)
{
    // $area->favorites の取得が正しいか確認
    $favorites = $area->favorites;

    return view('favorite', ['favoriteStores' => $favorites]);
}
public function __construct()
{
    $this->middleware('auth');
}
}