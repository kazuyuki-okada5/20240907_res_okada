@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="search-container">
    <div class="search-group">
        <div class="search-area">
            <form action="{{ route('store.search') }}" method="GET">
                <select name="area_id">
                    <option value="">All area</option>
                    <option value="1">東京都</option>
                    <option value="2">大阪府</option>
                    <option value="3">福岡県</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="search-genre">
            <select class="search-genre-select" onchange="selectRegistrationGenre()">
                <option value="genre1">ジャンル1</option>
                <option value="genre2">ジャンル2</option>
                <option value="genre3">ジャンル3</option>
                <!-- 必要に応じて他のジャンルを追加 -->
            </select>
        </div>
        <div class="search-words">
            <input type="text" id="keyword" placeholder="キーワードを入力" onkeydown="handleKeyDown(event)">
            <button onclick="search()">検索</button>
        </div>
    </div>
<div class="store-container">
    <div class="store-group">
        <div class="store-info">
            <img src="store_image.jpg" alt="店画像">
            <h3>店舗名</h3>
            <p>地域名</p>
            <p>ジャンル名</p>
            <button class="detail-button" onclick="location.href='/store_detail'">詳細</button>
            <button class="favorite-button"><i class="fas fa-heart"></i></button>
        </div>
    </div>
</div>
@endsection