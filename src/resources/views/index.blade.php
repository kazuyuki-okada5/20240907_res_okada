@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <div class="search-container">
        <div class="search-group">
            <div class="search-area">
                <form action="javascript:void(0);" method="GET" id="areaForm">
                    <select name="area_id">
                        <option value="">All area</option>
                        @isset($areas)
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ $selectedAreaId == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
                            @endforeach
                        @endisset
                    </select>
                </form>
            </div>
            <div class="search-genre">
                @if(isset($genres))
                    <form action="javascript:void(0);" method='GET' id="genreForm">
                        <select name="genre_id">
                            <option value="">All genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $selectedGenreId == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
            <div class="search-words">
                <form action="javascript:void(0);" method='GET' id="keywordForm">
                    <input type="text" name="keyword" id="keyword" value="{{ $keyword ?? ''}}">
                </form>
            </div>
        </div>
    </div>

    <div class="store-container">
        @if(isset($stores) && $stores->count() > 0)
            @foreach($stores as $store)
                <div class="store-group">
                    <div class="store-info">
                        <div class="store-image">
                            <img src="{{ $store->image_url }}" alt="{{ $store->name }}">
                        </div>
                        <h3>{{ $store->name }}</h3>
                        <p class="store-meta">#{{ $store->area->area }}</p>
                        <p class="store-meta">#{{ $store->genre->genre }}</p>
                        <br>
                        <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳しく見る</button>
                        <!-- 認証されている場合のみアイコンを表示 -->
                        @auth
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
            <p>現在、登録されている店舗はありません。</p>
        @endif
    </div>

    <!-- CSRFトークンを設定 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- JavaScript ファイルを読み込む -->
    <script src="/js/index_script.js"></script>
</body>
</html>
@endsection
