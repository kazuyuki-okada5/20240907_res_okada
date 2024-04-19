@extends('layouts.app')



<link rel="stylesheet" href="/css/index.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
<div class="search-container">
    <div class="search-group">
        <div class="search-area">
            <form action="javascript:void(0);" method="GET" id="areaForm">
                <select name="area_id">
                    <option value="">All area</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ $selectedAreaId == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
                    @endforeach
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
                <input type="text" name="keyword" id="keyword" placeholder="キーワードを入力" value="{{ $keyword ?? ''}}">

            </form>
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

<!-- スクリプト追記部分 -->
<script>
    const userFavoriteStores = {!! $userFavoriteStoresJson !!};

    async function toggleFavorite(buttonElement){
        const storeId = buttonElement.getAttribute('data-store-id');
        const icon = buttonElement.querySelector('.fa-heart');

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
    function search() {
    const areaId = document.querySelector('#areaForm select[name="area_id"]').value;
    const genreId = document.querySelector('#genreForm select[name="genre_id"]').value;
    const keyword = document.getElementById('keyword').value;

    let params = [];

    if (areaId) {
        params.push(`area_id=${areaId}`);
    }

    if (genreId) {
        params.push(`genre_id=${genreId}`);
    }

    if (keyword) {
        params.push(`keyword=${keyword}`);
    }

    const queryString = params.join('&');
    
    // Ajaxを使用して検索結果を取得
    fetch(`/stores/search?${queryString}`)
        .then(response => response.text())
        .then(data => {
            // ここでレイアウトを取り除く
            const container = document.createElement('div');
            container.innerHTML = data;
            const content = container.querySelector('.store-container').innerHTML;
            document.querySelector('.store-container').innerHTML = content;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

    // フォームの変更時に検索を自動的に実行
    document.getElementById('areaForm').addEventListener('change', search);
    document.getElementById('genreForm').addEventListener('change', search);
    document.getElementById('keywordForm').addEventListener('input', search); // inputイベントはキーワード入力時に発火
</script>
@endsection