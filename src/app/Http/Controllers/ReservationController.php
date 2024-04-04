<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // 予約を作成する処置

        // 予約作成後にリダイレクトする先のルートを指定する
        return redirect()->route('booking_is_done');
    }
}
