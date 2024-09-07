@extends('layouts.app')

@section('content')
<!-- CSS ファイルの読み込み -->
<link rel="stylesheet" href="{{ asset('css/review_list.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<!-- 口コミ一覧ページ -->
<main class="main">
    <!-- 店舗詳細 -->
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
        <div class="store-area-genre">
            <p>#{{ $store->area->area }}</p>
            <p>#{{ $store->genre->genre }}</p>
        </div>
        <div class="image-overview">
            <img src="{{ $store->image_url }}" alt="{{ $store->name }}" class="store-image">        
            <p class="overview">{{ $store->store_overview }}</p>
        </div>
    </div>
    <!-- 口コミ表示 -->
    <div class="reviews-container">
        <h3>口コミ一覧</h3>
        @if(isset($reviews) && $reviews->isNotEmpty())
            @foreach($reviews as $review)
                <div class="review">
                    <div class="star-update-destroy">
                        <div class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" style="color: {{ $review->rating >= $i ? 'gold' : 'gray' }}">&#9733;</span>
                            @endfor
                        </div>
                        <div class="update-destroy">
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
                    <div class="user-name-day">
                        <p class="user-name">投稿者: {{ $review->user->name }}</p>
                        <p class="creat-day">投稿日: {{ $review->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div class="comment-image">
                        <p class="comment">{{ $review->comment }}</p>
                        @if($review->image_path)
                            <img src="{{ asset('storage/' . $review->image_path) }}" class="img" alt="Review Image">
                        @endif
                    </div>

                </div>
            @endforeach
        @else
            <p>まだ口コミがありません。</p>
        @endif
    </div>
</main>
@endsection