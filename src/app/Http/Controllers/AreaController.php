<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        // エリア名を取得してビューに渡す
        $areas = Area::all();

        return view('index', ['areas' => $areas]);
    }
}