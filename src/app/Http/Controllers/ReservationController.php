<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB; // 追加


class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'store_id' => 'required|exists:stores,id',
            'date' => 'required|date',
            'time' => 'required',
            'num_people' => 'required|integer|min:1|max:20',
        ];

        // バリデーションメッセージを定義
        $messages = [
            'store_id.exists' => '指定された店舗は存在しません。',
            'date.required' => '日付は必須です。',
            'date.date' => '日付の形式が不正です。',
            'time.required' => '時間は必須です。',
            'num_people.required' => '人数は必須です。',
            'num_people.integer' => '人数は整数で入力してください。',
            'num_people.min' => '人数は1以上で入力してください。',
            'num_people.max' => '人数は20以下で入力してください。',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules, $messages);

        // $storeオブジェクトを取得
        $store = Store::find($validatedData['store_id']);

        // $storeがnullの場合はエラーハンドリング
        if (!$store) {
            return redirect()->back()->with('error', '指定された店舗は存在しません');
        }

        // 日時を結合結合
        $startDateTime = $request->date . ' ' . $request->time;

        // 予約を作成して保存
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->store_id = $validatedData['store_id'];
        $reservation->start_at = $startDateTime;
        $reservation->number_of_people = $validatedData['num_people'];
        $reservation->save();

        // リダイレクトなどの適切なレスポンスを返す
        return redirect()->route('booking_is_done');

        // ユーザーが認証されていない場合、ログインページにリダイレクト
        
    }

    public function index()
{
    // ログインしているユーザーのIDを取得
    $userId = auth()->user()->id;
    
    // 予約データをstart_atが早い順にソート
    $reservationDetails = Reservation::where('user_id', $userId)
                                    ->orderBy('start_at', 'asc')
                                    ->get();

    return view('reservations.index', compact('reservationDetails'));
}

    public function destroy(Reservation $reservation)
{
    // 認証ユーザーの予約として予約を削除
    if ($reservation->user_id === auth()->id()) {
        $reservation->delete();
        return back();
    }
}

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
{
    try {
        DB::beginTransaction();

        // バリデーションルールを定義
        $rules = [
            'date' => 'required|date',
            'time' => 'required',
            'num_people' => 'required|integer|min:1|max:20',
        ];

        // バリデーションを実行
        $validatedData = $request->validate($rules);

        // ログを追加してデータを確認
        \Log::info('Request Data:', $request->all());
        \Log::info('Validated Data:', $validatedData);

        // 新しい日付を結合
        $newStartDateTime = $validatedData['date'].' '.$validatedData['time'];

        // 予約情報を更新
        \Log::info('Reservation Data Before Save:', $reservation->toArray());
        $reservation->start_at = $newStartDateTime;
        $reservation->number_of_people = $validatedData['num_people'];
        $reservation->save();

        DB::commit();

        // リダイレクトなどの適切なレスポンスを返す
        return redirect()->route('reservations.index')->with('success', '予約情報を更新しました');
    } catch (\Exception $e) {
        DB::rollback();
        // トランザクションがロールバックされた場合の処理
        throw $e; // 例外を再スローしてエラーを処理する
    }
}
}
