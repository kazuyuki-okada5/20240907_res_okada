<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller

{
    public function index()
    {
        //　特定のユーザーのお気に入りを取得する例
        $userId = auth()->user()->id;
        $favorites = Favorite::where('user_id', $userId)->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {

    }

    public function destroy(Favorite $favorite)
    {
    
    }
}