@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/favorite.css') }}">
    <!-- Font Awesome の CDN を読み込む -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <div class="user-container">
        <div class="user-list">
            <div class="user-name">
                <!-- ユーザー名表示 -->
                {{ $user->name ?? '' }}さんの予約・お気に入りページ
            </div>
        </div>
    </div>

    <div class="mypage-container">
        
        <!-- 予約状況 -->
        <div class="reservation-container">
            <div class="reservation-group">
                <h2>〜予約状況〜</h2>
                <div class="reservation-details">
                    @foreach ($reservationDetails as $reservation)
                    <div class="reservation-item">
                        <div class="reservation-header">
                            <span class="material-symbols-outlined">schedule</span>
                            <strong>予約:</strong> {{ $loop->iteration }}
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('この予約を削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cancel-button"><i class="fas fa-times"></i></button>
                            </form>
                        </div>
                        <div class="reservation-info">
                            <strong>Shop:</strong> {{ $reservation->store->name }}<br>
                            <strong>Date:</strong> {{ $reservation->start_at->format('Y-m-d') }}<br>
                            <strong>Time:</strong> {{ $reservation->start_at->format('H:i') }}<br>
                            <strong>Number:</strong> {{ $reservation->number_of_people }}人
                        </div>
                        <div class="reservation-action">
                            <form action="{{ route('reservations.edit', $reservation->id) }}" method="GET">
                                <button type="submit" class="edit-button">変更</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- お気に入り店舗 -->
        <div class="favorite-container">
            <div class="favorite-group">
                <h2>〜お気に入り店舗〜</h2>
                    <div class="favorite-items">
                    @foreach ($favoriteStores ?? [] as $favorite)
                        <div class="favorite-item">
                            <img src="{{ $favorite->store->image_url }}" alt="{{ $favorite->store->name }}">
                            <h3>{{ $favorite->store->name }}</h3>
                                <div class="info-container">
                                    <p>#{{ $favorite->store->area->area }}</p>
                                    <p>#{{ $favorite->store->genre->genre }}</p>
                                </div>
                                <div class="info-button">
                                    <button class="detail-button" onclick="location.href='/store_detail/{{ $favorite->store->id }}'">詳しく見る</button>
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
</div>
@endsection