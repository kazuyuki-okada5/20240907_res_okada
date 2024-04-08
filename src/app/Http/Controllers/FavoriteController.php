<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;

class FavoriteController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $favorites = Favorite::where('user_id', $userId)->get();

        return view('favorite', compact('favorites'));
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
        $favorites = $area->favorites;
        return view('favorite', compact('favorites'));
    }
}