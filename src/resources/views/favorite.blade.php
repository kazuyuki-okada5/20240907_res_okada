@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<!-- Font Awesome の CDN を読み込む -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('content')
<div class="user-container">
    <div class="user-list">
        <div class="user-name">
            //ユーザー名表示
        </div>
    </div>
</div>
    <div class="mypage-container">
        <div class="reservation-container">
            <div class="reservation-group">
                <p>予約状況</p>
                <div class="reservation-details">
                    @foreach ($reservationDetails ??[] as $key => $value)
                        <p><strong>{{ $key }}:</strong> {{ $value }}</p>
                    @endforeach
                    <button class="cancel-button"><i class="fas fa-times"></i></button>
                </div>
            </div>
        
        <div class="store-container">
            <div class="store-group">
                <p>お気に入り店舗</p>
                <div class="store-details">
                    @foreach ($storeDetails ??[] as $key => $value)
                        <p><strong>{{ $key }}}:</strong> {{ $value }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection