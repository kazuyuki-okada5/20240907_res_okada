@extends('layouts.app')



@section('content')
    <h1>店舗代表者用ホーム画面</h1>
    <h2>店舗情報登録</h2>

<form action="{{ route('stores.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="店舗名">
    
    <label for="area_id">エリア:</label>
    <select name="area_id" id="area_id">
        @foreach($areas as $area)
            <option value="{{ $area->id }}">{{ $area->area }}</option>
        @endforeach
    </select>
    
    <label for="genre_id">ジャンル:</label>
    <select name="genre_id" id="genre_id">
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
        @endforeach
    </select>
    
    <textarea name="store_overview" placeholder="店舗概要"></textarea>
    <input type="text" name="image_url" placeholder="画像URL">
    <button type="submit">保存</button>
</form>


    <h2>登録済みの店舗</h2>
    @foreach ($userStores as $userStore)
        <li>
            <!-- 店舗情報の表示 -->
            <p>店舗名: {{ $userStore->store->name }}</p>
            <p>エリア: {{ $userStore->store->area->area }}</p>
            <p>ジャンル: {{ $userStore->store->genre->genre }}</p>
            <p>店舗概要: {{ $userStore->store->store_overview }}</p>
            <img src="{{ $userStore->store->image_url }}" alt="店舗画像">
            
            <!-- 「編集する」ボタン -->
            <button onclick="editStore({{ $userStore->store->id }})">編集する</button>

        </li>
        <!-- ここで予約一覧を表示 -->
        @if($userStore->store->reservations->isNotEmpty())
            <h3>予約一覧</h3>
            <ul>
                @foreach ($userStore->store->reservations as $reservation)
                    <li>
                        <p>予約ID: {{ $reservation->id }}</p>
                        <p>予約日時: {{ $reservation->start_at }}</p>
                        <p>予約人数: {{ $reservation->number_of_people }}</p>
                        <!-- その他の予約情報を表示 -->
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach

    <script>
        function editStore(storeId) {
            window.location.href = "/stores/" + storeId + "/edit";
        }
    </script>
@endsection