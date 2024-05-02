<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant reservation service</title>
    <link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    @extends('layouts.app')

    @section('content')
<div class="detail-container">
    <div class="detail-group">
        <div class="store-container">
            <div class="store-group">
                <div class="store-info">
                    <div class="detail-group">
                        <form action="{{ route('stores.index') }}" method="get"> <!-- こちらを変更 -->
                            @csrf
                            <button type="button" onclick="location.href='/stores'" class="back-button">
                                <i class="material-icons-outlined">arrow_back_ios</i>
                            </button>
                        </form>
                        <h3>{{ $store->name }}</h3>
<!-- 変更ボタン -->
<button onclick="location.href='{{ route('store.edit', $store->id) }}'" class="change-button">
    変更
</button>
<!-- 新規作成ボタン -->
<button onclick="location.href='{{ route('store.create') }}'" class="create-button">
    新規作成
</button>
                    </div>
                    <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                    <p>#{{ $store->area->area }}</p>
                    <p>#{{ $store->genre->genre }}</p>
                    <p>{{ $store->store_overview }}</p>
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