@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
@endsection

@section('content')
<div class="detail-container">
    <div class="detail-group">
        <div class="store-container">
            <div class="store-group">
                <div class="store-info">
                    <form action="{{ url('/') }}" method="get">
    @csrf
    <button type="submit" class="return-button">戻る</button>
</form>
                    <h3>店舗名</h3>
                    <img src="store_image.jpg" alt="店画像">
                    <p>地域名</p><p>ジャンル名</p>
                    <p>詳細</p>
                </div>
            </div>
        </div>
        <div class="booking-container">
            <div class="booking-group">
                <div class="booking-info">
                    <h3>予約</h3>
                    <form action="/reservation" method="post">
                        @csrf
                        <div>
                            <label for="store_name">店舗名:</label>
                            
                        </div>
                        <div>
                            <label for="date">日付:</label>
                            <input type="date" name="date" id="date">
                        </div>
                        <div>
                            <label for="time">時間:</label>
                            
                        </div>
                        <div>
                            <label for="num_people">人数:</label>
                            
                        </div>
                        <form action="{{ route('booking_is_done') }}" method="post">
                        @csrf
                        <button type="submit">予約する</button>
                    </form>
                </div>
                <div class="booking-confirm">
                    
                        <div>
                            <p>店舗名:</p>
                            <p>日付:</p>
                            <p>選択された時間:</p>
                            <p>選択された人数:</p>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection