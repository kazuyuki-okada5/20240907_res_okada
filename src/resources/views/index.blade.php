@extends('layouts.app')

@section('content')
<!-- CSS ファイルの読み込み -->
<link rel="stylesheet" href="/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<head>
    <meta name="viewport" content="width=590, initial-scale=1">
</head>
<!-- 検索フォーム -->
<div class="search-container">
    <div class="manager-representative-group">
    <!-- 管理者または店舗代表者用ページボタン -->
        @auth
            @if(Auth::user()->role === 'manager')
                <div class="manager-button">
                    <button onclick="location.href='/manager/home'" class="btn btn-primary">管理者ページへ</button>
               </div>
                <div class="create-notice-button">
                    <a href="{{ route('notice.create') }}" class="btn btn-primary">お知らせ作成</a>
                </div>
            @elseif(Auth::user()->role === 'representative')
                <div class="representative-button">
                    <button onclick="location.href='/representative/home'" class="btn btn-primary">店舗代表者ページへ</button>
                </div>
            @endif
        @endauth
    </div>
    <div class="search-group">
        <!-- ソートオプション -->
        <div class="sort-container">
            <form action="{{ route('index') }}" method="GET" id="sortForm">
                <label for="sort">並び替え:</label>
                <select name="sort" class="search-list" id="sort" onchange="document.getElementById('sortForm').submit();">
                    <option value="">デフォルト</option>
                    <option value="high_rating" {{ request('sort') === 'high_rating' ? 'selected' : '' }}>評価の高い順</option>
                    <option value="low_rating" {{ request('sort') === 'low_rating' ? 'selected' : '' }}>評価の低い順</option>
                    <option value="random" {{ request('sort') === 'random' ? 'selected' : '' }} >ランダム</option>
                </select>
            </form>
        </div>
        <!-- エリアの選択 -->
        <div class="search-area">
            <form action="javascript:void(0);" method="GET" id="areaForm">
                <select name="area_id">
                    <option value="">All area</option>
                    <!-- エリアのオプション -->
                    @isset($areas)
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ $selectedAreaId == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
                        @endforeach
                    @endisset
                </select>
            </form>
        </div>
        <!-- ジャンルの選択 -->
        <div class="search-genre">
            @if(isset($genres))
                <form action="javascript:void(0);" method='GET' id="genreForm">
                    <select name="genre_id">
                        <option value="">All genre</option>
                        <!-- ジャンルのオプション -->
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $selectedGenreId == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
                            @endforeach
                    </select>
                </form>
            @endif
        </div>
            <!-- キーワード検索 -->
        <div class="search-words">
            <form action="javascript:void(0);" method='GET' id="keywordForm">
                <input type="text" name="keyword" id="keyword" value="{{ $keyword ?? ''}}">
            </form>
        </div>
    </div>
</div>
<main class="main">
    <!-- 店舗リスト -->
    <div class="store-container">
        <!-- 店舗が登録されている場合 -->
        @if(isset($stores) && $stores->count() > 0)
            @foreach($stores as $store)
                <div class="store-group">
                    <div class="store-info">
                        <!-- 店舗画像 -->
                        <div class="store-image">
                            <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                        </div>
                        <!-- 店舗情報 -->
                        <h3>{{ $store->name }}</h3>
                        <p class="store-meta">#{{ $store->area->area }}</p>
                        <p class="store-meta">#{{ $store->genre->genre }}</p>
                        <br>
                        <!-- 詳細ページへのリンク -->
                        <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳しく見る</button>
                        <!-- お気に入りボタン -->
                        @auth
                            <!-- 認証されたユーザーの場合 -->
                            <button class="favorite-button" 
                                    data-store-id="{{ $store->id }}" 
                                    onclick="toggleFavorite(this)"
                                    style="color: {{ in_array($store->id, $userFavoriteStores ?? []) ? 'red' : '#A9A9A9' }};">
                                <i class="fa fa-heart" id="heart-icon"></i>
                            </button>
                        @endauth
                    </div>
                </div>
            @endforeach
        @else
            <!-- 登録された店舗がない場合 -->
            <p>現在、登録されている店舗はありません。</p>
        @endif
    </div>
    <!-- CSRFトークン -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/index_script.js"></script>
</main>
@endsection


