@extends('layouts.app')

@section('content')
    <!-- CSSファイルの読み込み -->
    <link rel="stylesheet" href="{{ asset('css/favorite.css') }}">
    <!-- Font Awesome の CDN を読み込む -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Google Fonts の CDN を読み込む -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <!-- ユーザー情報表示 -->
    <div class="user-container">
        <div class="user-list">
            <div class="user-name">
                <!-- ユーザー名表示 -->
                {{ $user->name ?? '' }}さんの予約・お気に入りページ
            </div>
        </div>
    </div>

    <!-- マイページコンテンツ -->
    <div class="mypage-container">
        <!-- 予約状況 -->
        <div class="reservation-container">
            <div class="reservation-group">
                <h2>〜予約状況〜</h2>
                <div class="reservation-details">
                    <!-- 予約情報表示 -->
                    @isset($reservationDetails)
                        @foreach ($reservationDetails as $reservation)
                            <div class="reservation-item">
                                <div class="reservation-header">
                                    <span class="material-symbols-outlined">schedule</span>
                                    <!-- 予約情報 -->
                                    <strong>予約:</strong> {{ $loop->iteration }}
                                    <!-- 予約キャンセルボタン -->
                                    @unless($reservation->isPastReservation)
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('この予約を削除しますか？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cancel-button"><i class="fas fa-times"></i></button>
                                        </form>
                                    @endunless
                                </div>
                                <div class="reservation-info">
                                    <!-- 予約詳細 -->
                                    <strong>Shop:</strong> {{ $reservation->store->name }}
                                    <br>
                                    <strong>Date:</strong> {{ $reservation->start_at->format('Y-m-d') }}
                                    <br>
                                    <strong>Time:</strong> {{ $reservation->start_at->format('H:i') }}
                                    <br>
                                    <strong>Number:</strong> {{ $reservation->number_of_people }}人
                                    <!-- 予約変更ボタン -->
                                    @unless($reservation->isPastReservation)
                                        <form action="{{ route('reservations.edit', $reservation->id) }}" method="GET">
                                            <button type="submit" class="edit-button">変更</button>
                                        </form>
                                    @endunless
                                    <!-- 評価リンク -->
                                    @if($reservation->isPastReservation)
                                        <a href="{{ route('reservations.evaluateForm', $reservation->id) }}" class="btn btn-primary">評価する</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>

        <!-- お気に入り店舗 -->
        <div class="favorite-container">
            <div class="favorite-group">
                <h2>〜お気に入り店舗〜</h2>
                <div class="favorite-items">
                    <!-- お気に入り店舗リスト -->
                    @foreach ($favoriteStores ?? [] as $favorite)
                        <div class="favorite-item">
                            <!-- 店舗情報 -->
                            <img src="{{ $favorite->store->image_url }}" alt="{{ $favorite->store->name }}">
                            <h3>{{ $favorite->store->name }}</h3>
                            <div class="info-container">
                                <p>#{{ $favorite->store->area->area }}</p>
                                <p>#{{ $favorite->store->genre->genre }}</p>
                            </div>
                            <div class="info-button">
                                <!-- 詳細ボタン -->
                                <button class="detail-button" onclick="location.href='/store_detail/{{ $favorite->store->id }}'">詳しく見る</button>
                                <!-- お気に入り削除フォーム -->
                                @auth
                                    <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST" onsubmit="return confirm('この店舗をお気に入りから削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="favorite-button">
                                            <i class="fa fa-heart" id="heart-icon" style="color: #fa0606;"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
