<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant reservation service</title>
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
    <!-- Font Awesomeのアイコンフォントの読み込み -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <!-- Material Iconsのアイコンフォントの読み込み -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    <!-- app.blade.phpを継承 -->
    @extends('layouts.app')

    @section('content')
    <!-- 予約情報変更フォーム -->
    <h2>予約変更画面</h2>
    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
        @csrf <!-- CSRFトークン -->
        @method('PUT') <!-- HTTPメソッドを指定 -->

        <!-- 予約日の入力 -->
        <div>
            <label for="date">予約日：</label>
            <input type="date" id="date" name="date" value="{{ old('date', $reservation->start_at->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
        </div>
        <!-- 予約時間の入力 -->
        <div>
            <label for="time">予約時間：</label>
            <select name="time" id="time">
                <option value="">予約時間を選択</option>
                @php
                    $startTime = strtotime('20:00');
                    $endTime = strtotime('22:00');
                    $interval = 15 * 60; // 15分を秒に変換
                @endphp
                @for ($time = $startTime; $time <= $endTime; $time += $interval)
                    <option value="{{ date('H:i', $time) }}" {{ old('time', $reservation->start_at->format('H:i')) == date('H:i', $time) ? 'selected' : '' }}>
                        {{ date('H:i', $time) }}
                    </option>
                @endfor
            </select>
        </div>
        <!-- 予約人数の入力 -->
        <div>
            <label for="num_people">予約人数：</label>
            <select name="num_people" id="num_people">
                <option value="">予約人数を選択</option>
                @for ($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}" {{ old('num_people', $reservation->number_of_people) == $i ? 'selected' : '' }}>
                        {{ $i }}人
                    </option>
                @endfor
            </select>
        </div>
        <!-- 保存ボタン -->
        <button type="submit">変更を保存する</button>
    </form>
    @endsection
</body>
</html>
