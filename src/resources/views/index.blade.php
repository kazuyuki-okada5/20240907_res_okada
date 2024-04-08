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
            <form action="{{ route('store.search') }}" method='GET'>
                <select name="genre_id">
                    <option value="">All genre</option>
                    <option value="1">寿司</option>
                    <option value="2">焼肉</option>
                    <option value="3">居酒屋</option>
                    <option value="4">イタリアン</option>
                    <option value="5">ラーメン</option>
                </select>
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="search-words">
            <input type="text" id="keyword" placeholder="キーワードを入力" onkeydown="handleKeyDown(event)">
            <button onclick="search()">検索</button>
        </div>
    </div>
@foreach($stores as $store)
    <div class="store-container">
        <div div class="store-group">
            <div class="store-info">
                <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                <h3>{{ $store->name }}</h3>
                <p>{{ $store->area->area }}</p>
                <p>{{ $store->genre->genre }}</p>
                <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳細</button>
                <button class="favorite-button"><i class="fas fa-heart"></i></button>
            </div>
        </div>
    </div>
@endforeach
@endsection