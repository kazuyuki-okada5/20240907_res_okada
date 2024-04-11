<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\StoreDetailController;

class StoreDetailController extends Controller
{
public function index()
{
    $times = [];

    // 18:00から22:00までの間で15分刻みの時間を生成
    $startTime = strtotime('18:00');
    $endTime = strtotime('22:00');
    $interval = 15 * 60; // 15分を秒に変換

    for ($time = $startTime; $time <= $endTime; $time += $interval) {
        $times[] = date('H:i', $time);
    }

    // ビューに時間の選択肢を渡す
    return view('store_detail', ['times' => $times]);
    }
}
