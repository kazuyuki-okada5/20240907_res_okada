@extends('layouts.app')

<link rel="stylesheet" href="/css/index.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    @if(isset($stores) && $stores->count() > 0)
        @foreach($stores as $store)
            <div class="store-group">
                <div class="store-info">
                    <div class="store-image">
                        <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                    </div>
                    <h3>{{ $store->name }}</h3>
                    <p>#{{ $store->area->area }}</p>
                    <p>#{{ $store->genre->genre }}</p>
                    <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳しく見る</button>
                    <!-- 認証されている場合のみアイコンを表示 -->
                    @auth
<button class="favorite-button" 
        data-store-id="{{ $store->id }}" 
        onclick="changeIconColor(this)"
        style="color: {{ in_array($store->id, $userFavoriteStores) ? 'red' : '#A9A9A9' }};">
    <i class="fa fa-heart" id="heart-icon"></i>
</button>
                    @endauth
                </div>
            </div>
        @endforeach
    @else
        <p>現在、登録されている店舗はありません。</p>
    @endif
</div>

<!-- スクリプト追記部分 -->
<script>
    async function changeIconColor(buttonElement) {
        const storeId = buttonElement.getAttribute('data-store-id');

        const icon = buttonElement.querySelector('.fa-heart');
        
        // 現在の色を取得
        const currentColor = window.getComputedStyle(icon).color;

        const response = await fetch(`/toggle-favorite/${storeId}`, { // テンプレートリテラルを使用して修正
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();

        if(data.status === 'added') {
            icon.style.color = 'red';
        }else{
            icon.style.color = '#A9A9A9';
        }
        }
</script>
@endsection