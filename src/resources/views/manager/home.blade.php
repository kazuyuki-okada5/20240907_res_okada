@extends('layouts.app')

@section('content')
<body>
    <h2>管理者用ホーム画面</h2>

    <!-- 店舗代表者を店舗に新規登録フォーム -->
    <h3>店舗代表者を店舗に新規登録</h3>
    <form action="{{ route('representatives.store') }}" method="POST">
    @csrf <!-- CSRFトークン -->
        <div>
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required>
            <!-- エラーメッセージ -->
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
            <!-- エラーメッセージ -->
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password" required>
            <!-- エラーメッセージ -->
            @error('password')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="store_id">店舗ID:</label>
            <select name="store_id" id="store_id" required>
                <!-- 店舗選択のオプション -->
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
            <!-- エラーメッセージ -->
            @error('store_id')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">新規登録</button>
    </form>

    <!-- 店舗代表者に店舗を関連付けるフォーム -->
    <h3>店舗代表者に店舗を関連付ける</h3>
    <form action="{{ route('stores.attachRepresentative') }}" method="POST">
    @csrf <!-- CSRFトークン -->
        <div>
            <label for="representative_id">店舗代表者:</label>
            <select name="representative_id" id="representative_id">
                <!-- 店舗代表者選択のオプション -->
                @foreach($representatives as $representative)
                    <option value="{{ $representative->id }}">{{ $representative->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="store_id">関連付ける店舗ID:</label>
            <select name="store_id" id="store_id">
                <!-- 店舗選択のオプション -->
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">関連付ける</button>
    </form>
</body>
</html>
@endsection

