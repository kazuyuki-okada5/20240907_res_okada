<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
public function store(Request $request)
{
    // バリデーションルールを定義
    $rules = [
        'store_id' => 'required|exists:stores,id', // store_idが必須であることを指定
        // 他のバリデーションルールを追加する
    ];

    // バリデーションを実行
    $validatedData = $request->validate($rules);

    // 予約を作成して保存
    $reservation = new Reservation();
    $reservation->user_id = auth()->user()->id;
    $reservation->store_id = $validatedData['store_id']; // バリデーション済みのstore_idを使用
    $reservation->start_at = $request->date .' ' . $request->time;
    $reservation->number_of_people = $request->num_people;
    $reservation->save();

    // リダイレクトなどの適切なレスポンスを返す
    return redirect()->back()->with('success', '予約が完了しました！');
    }
    public function destroy(Reservation $reservation)
    {
        // 予約を削除するロジックをここに記述
    }
}
