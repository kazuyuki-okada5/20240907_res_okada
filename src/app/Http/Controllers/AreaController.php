<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    // エリアの一覧を表示するアクション
    public function index()
    {
        // エリア名を取得してビューに渡す
        $areas = Area::all();

        // エリア名を取得してビューに渡す
        return view('index', ['areas' => $areas]);
    }
}