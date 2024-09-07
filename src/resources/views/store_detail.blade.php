@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/store_detail.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<!-- 店舗詳細 -->
 <main class="main">
    <div class="detail-container">
        <div class="detail-group">
            <div class="store-container">
                <div class="store-group">
                    <div class="store-info">
                        <div class="detail-group">
                            <form action="{{ route('stores.index') }}" method="get">
                            @csrf
                                <button type="button" onclick="location.href='/stores'" class="back-button">
                                    <i class="material-icons-outlined">arrow_back_ios</i>
                                </button>
                            </form>
                            <h3 class="store-name">{{ $store->name }}</h3>
                        </div>
                        <img src="{{ $store->image_url }}" alt="{{ $store->name }}" class="store-image">
                        <div class="store-area-genre">
                            <p>#{{ $store->area->area }}</p>
                            <p class="genre">#{{ $store->genre->genre }}</p>
                        </div>
                        <p class="overview">{{ $store->store_overview }}</p>
                    </div>
                </div>                
                <!-- 口コミページへの移動ボタン -->
                @if (!auth()->guest() && !app('App\Http\Controllers\ReviewController')->hasReviewed($store->id))
                    <div class="move-button-container">
                        <a href="{{ route('store_reviews.show', ['storeId' => $store->id]) }}" class="move-button">口コミを投稿する</a>
                    </div>
                @endif
                <!-- 口コミ一覧へのリンクタブ -->
                @if($review)
                    <div class="review-link">
                        <a href="{{ route('store.reviews_list', $store->id) }}" class="move-button">全ての口コミ情報</a>
                    </div>
                @endif
                <!-- 口コミ表示 -->
                <div class="reviews-container">
                    <h3 class="new-review">最新の口コミ</h3>                          
                    @if($review)
                        <div class="review">
                            <div class="star-rating">
                                <div class="star-gloup">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star" style="color: {{ $review->rating >= $i ? 'gold' : 'gray' }}">&#9733;</span>
                                    @endfor
                                </div>
                                <div class="review-actions">
                                    @can('update', $review)
                                        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">口コミを編集</a>
                                    @endcan
                                    @can('delete', $review)
                                        <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $review->id }}').submit();">口コミを削除</a>
                                        <form id="delete-form-{{ $review->id }}" action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                </div>
                            </div>
                            <p class="review-comment">{{ $review->comment }}</p>
                            <div class="review-posted">
                                <p>投稿日: {{ $review->created_at->format('Y-m-d H:i') }}</p>
                                <p>投稿者: {{ $review->user->name }}</p>
                            </div>
                        </div>
                    @else
                        <p>まだ口コミがありません。</p>
                    @endif
                </div>
            </div>
            <!-- 予約情報 -->
            <div class="booking-container">
                <div class="booking-group">
                    <div class="booking-info">
                        <h3>予約</h3>
                        @if (Auth::check())
                            <!-- ログイン済み -->
                            <form action="/reservation" method="post" id="bookingForm">
                                @csrf
                                <input type="hidden" name="store_id" value="{{ $store->id }}">
                                <div class="date-label">
                                    <label for="date"></label>
                                    <input type="date" name="date" id="date" class="date-label" value="{{ old('date') }}" min="{{ date('Y-m-d') }}">
                                    @error('date')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="reservation-time">
                                    <label for="time" class="date-time"></label>
                                    <select name="time" id="time" class="reservation-time">
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
                                    @error('time')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="reservation-people">
                                    <label for="num_people" class="date-num-people"></label>
                                    <select name="num_people" id="num_people" class="reservation-people">
                                        <option value="" {{ old('num_people') == "" ? 'selected' : '' }}>予約人数を選択</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ old('num_people') == $i ? 'selected' : '' }}>{{ $i }}人</option>
                                        @endfor
                                    </select>
                                    @error('num_people')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- 予約確認 -->
                                <div class="booking-confirm">
                                    <div>
                                        <p>店舗名: <span id="displayStoreName">{{ $store->name }}</span></p>
                                        <p>予約日: <span id="displayDate"></span></p>
                                        <p>予約時間: <span id="displayTime"></span></p>
                                        <p>予約人数: <span id="displayNumPeople"></span></p>
                                    </div>
                                </div>
                                <button type="submit" class="submit-button">予約する</button>
                            </form>
                            @else
                            <p>予約を行うにはログインが必要です</p>
                            <div>
                                <button onclick="location.href='/login'">ログイン</button>
                                <button onclick="location.href='/register'">新規登録</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<!-- JavaScript ファイルの読み込み -->
<script src="{{ asset('js/reservation.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // スター評価の処理
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;
            updateStarSelection(rating);
        });
    });

    function updateStarSelection(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }
});
</script>
@endsection


