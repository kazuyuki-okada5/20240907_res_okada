@extends('layouts.app')

<link rel="stylesheet" href="/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
</div>
<div class="store-container" style="max-width: 1200px; margin: 0 auto;">
@foreach($stores as $store)
    <div class="store-group"> <!-- ここが.store-groupになる -->
        <div class="store-info">
            <div class="store-image">
                <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
            </div>
            <h3>{{ $store->name }}</h3>
            <p>#{{ $store->area->area }}</p>
            <p>#{{ $store->genre->genre }}</p>
            <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳しく見る</button>
            <button class="favorite-button"><i class="fas fa-heart"></i></button>
        </div>
    </div>
@endforeach
</div>

<script>
document.querySelectorAll('.favorite-button').forEach(button => {
    button.addEventListener('click', function() {
        this.classList.toggle('active');
    });
});
</script>
@endsection