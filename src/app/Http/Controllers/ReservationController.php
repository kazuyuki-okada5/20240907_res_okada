<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReservationRequest;


class ReservationController extends Controller
{
    public function store(StoreReservationRequest $request)
    {
        // リクエストがバリデートされたデータは、$request->validated() を使用して取得できます
        $validatedData = $request->validated();

        // $storeオブジェクトを取得
        $store = Store::find($validatedData['store_id']);

        // $storeがnullの場合はエラーハンドリング
        if (!$store) {
            return redirect()->back()->with('error', '指定された店舗は存在しません');
        }

        // 日時を結合結合
        $startDateTime = $validatedData['date'] . ' ' . $validatedData['time'];

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
    public function evaluateForm(Reservation $reservation)
    {
        return view('evaluation', compact('reservation'));
    }

    public function evaluate(Request $request, Reservation $reservation)
    {
        // バリデーションを実行
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // バリデーションが成功した場合、評価とコメントを保存
        $evaluation = new Evaluation();
        $evaluation->reservation_id = $reservation->id;
        $evaluation->rating = $validatedData['rating'];
        $evaluation->comment = $validatedData['comment'];
        $evaluation->save();

        // リダイレクトして評価完了ページに移動
        return redirect()->route('evaluation_complete');
    }

    public function show($reservationId)
{
    $reservation = Reservation::find($reservationId);

    if (!$reservation) {
        return abort(404); // 予約が見つからない場合は404エラーを返す
    }


}
}
