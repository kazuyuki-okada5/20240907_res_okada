<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約ページ</title>
    <link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>
<body>
    @extends('layouts.app')

    @section('content')
<div class="detail-container">
    <div class="detail-group">
        <div class="store-container">
            <div class="store-group">
                <div class="store-info">
                    <form action="{{ route('stores.index') }}" method="get"> <!-- こちらを変更 -->
                            @csrf
                            <button type="submit" class="return-button">戻る</button>
                        </form>
                    <h3>{{ $store->name }}</h3>
                    <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                    <p>{{ $store->area->area }}</p>
                    <p>{{ $store->genre->genre }}</p>
                    <p>{{ $store->store_overview }}</p>
                </div>
            </div>
        </div>
        <div class="booking-container">
            <div class="booking-group">
                <div class="booking-info">
                    <h3>予約</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- フォーム -->
                    <form action="/reservation" method="post" id="bookingForm">
                        @csrf
                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                        
                        <div>
                            <label for="date">日付:</label>
                            <input type="date" name="date" id="date" value="{{ old('date') }}">
                        </div>
                        
                        <div>
                            <label for="time">予約時間:</label>
                            <select name="time" id="time">
                                <option value="" {{ old('time') == "" ? 'selected' : '' }}>予約時間を選択</option>
                                @php
                                    $startTime = strtotime('20:00');
                                    $endTime = strtotime('22:00');
                                    $interval = 15 * 60; // 15分を秒に変換
                                @endphp
                                @for ($time = $startTime; $time <= $endTime; $time += $interval)
                                    <option value="{{ date('H:i', $time) }}" {{ old('time') == date('H:i', $time) ? 'selected' : '' }}>{{ date('H:i', $time) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label for="num_people">予約人数:</label>
                            <select name="num_people" id="num_people">
                                <option value="" {{ old('num_people') == ""?'selected' : ''}}>予約人数を選択</option>
                                @for ($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                @endfor
                            </select>
                        </div>
                        
                        <!-- 予約確認エリア -->
                        <div class="booking-confirm">
                            <div>
                                <p>Shop: <span id="displayStoreName">{{ $store->name }}</span></p>
                                <p>Date: <span id="displayDate"></span></p>
                                <p>Time: <span id="displayTime"></span></p>
                                <p>Number of People: <span id="displayNumPeople"></span></p>
                            </div>
                        </div>
                        
                        <!-- 予約ボタン -->
                        <button type="submit" @guest onclick="event.preventDefault(); location.href='/login';" @else type="submit" @endguest>予約する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // フォームの各フィールドにイベントリスナーを追加
    document.getElementById('date').addEventListener('input', updateDisplay);
    document.getElementById('time').addEventListener('change', updateDisplay);
    document.getElementById('num_people').addEventListener('change', updateDisplay);

    // 表示を更新する関数
    function updateDisplay() {
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;
        const numPeople = document.getElementById('num_people').value;
        const storeName = document.getElementById('displayStoreName').textContent; // 店舗名を取得
        
        // 表示を更新
        document.getElementById('displayDate').textContent = date;
        document.getElementById('displayTime').textContent = time;
        document.getElementById('displayNumPeople').textContent = numPeople;
        document.getElementById('displayStoreName').textContent = storeName;  // 店舗名を表示
    }

    // フォーム送信時にデータを更新
    document.getElementById('bookingForm').addEventListener('submit', function() {
        updateDisplay();
    });
</script>
@endsection
</body>
</html>