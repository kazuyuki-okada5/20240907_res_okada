@extends('layouts.app')



@section('content')
    <h1>店舗編集</h1>
    <form action="{{ route('stores.update', ['store' => $store->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">店舗名:</label>
            <input type="text" id="name" name="name" value="{{ $store->name }}" required>
        </div>
        <div>
            <label for="area_id">エリア:</label>
            <select id="area_id" name="area_id" required>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" @if($area->id === $store->area_id) selected @endif>{{ $area->area }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="genre_id">ジャンル:</label>
            <select id="genre_id" name="genre_id" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" @if($genre->id === $store->genre_id) selected @endif>{{ $genre->genre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="store_overview">店舗概要:</label>
            <textarea id="store_overview" name="store_overview" required>{{ $store->store_overview }}</textarea>
        </div>
        <div>
            <label for="image_url">画像URL:</label>
            <input type="text" id="image_url" name="image_url" value="{{ $store->image_url }}" required>
        </div>
        <button type="submit">更新</button>
    </form>
</body>
</html>
@endsection