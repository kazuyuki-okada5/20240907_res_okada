@extends('layouts.app')

@section('content')
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
    
    <!-- コンテンツ -->
    <div class='container'>
        <!-- カード -->
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <!-- 評価フォーム -->
                <form method="POST" action="{{ route('reservations.evaluate', $reservation->id)}}">
                    @csrf
                    <!-- 評価入力欄 -->
                    <div class="form-group">
                        <label for="rating">評価</label>
                        <input id="rating" type="number" class="form-control" name="rating" min="1" max="5" required>
                    </div>
                    <!-- コメント入力欄 -->
                    <div class="form-group">
                        <label for="comment">コメント</label>
                        <textarea id="comment" class="form-control" name="comment" rows="4" required></textarea>
                    </div>
                    <!-- 評価ボタン -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">評価する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection