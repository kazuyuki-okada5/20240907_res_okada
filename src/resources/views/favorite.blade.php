@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<!-- Font Awesome の CDN を読み込む -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


@section('content')
<div class="user-container">
    <div class="user-list">
        <div class="user-name">
            <!-- ユーザー名表示 -->
            {{ $user->name ?? '' }}さん
        </div>
    </div>
</div>
    <div class="mypage-container">
        <div class="reservation-container">
            <div class="reservation-group">
                <p>予約状況</p>
                <div class="reservation-details">
                    @foreach ($reservationDetails ??[] as $reservation)
                        <p>
                            <span class="material-symbols-outlined">
                                schedule
                            </span>
                            <strong>予約:</strong> {{ $loop->iteration }}
                            <button class="cancel-button"><i class="fas fa-times"></i></button><br>
                            <strong>Shop:</strong> {{ $reservation->store->name }}<br>
                            <strong>Date:</strong> {{ $reservation->start_at->format('Y-m-d') }}<br>
                            <strong>Time:</strong> {{ $reservation->start_at->format('H:i') }}<br>
                            <strong>Number:</strong>{{ $reservation->number_of_people }}
                        </p>
                    @endforeach
                </div>
            </div>
        
        <div class="favorite-container">
            <div class="favorite-group">
                <p>お気に入り店舗</p>
                @foreach ($favoriteStores ?? [] as $favorite)
    <div class="favorite-details">
        <img src="{{ $favorite->store->image_url }}" alt="{{ $favorite->store->name }}">
        <h3>{{ $favorite->store->name }}</h3>
        <p>#{{ $favorite->store->area->area }}</p>
        <p>#{{ $favorite->store->genre->genre }}</p>
        <button class="detail-button" onclick="location.href='/store_detail/{{ $favorite->store->id }}'">詳しく見る</button>
        @auth
        <button class="favorite-button" data-store-id="{{ $favorite->store->id }}" onclick="changeIconColor(this)">
            <i class="fa fa-heart" id="heart-icon" style="color: #A9A9A9;"></i>
        </button>
        @endauth
    </div>
@endforeach
            </div>
        </div>
    </div>
</div>
@endsection