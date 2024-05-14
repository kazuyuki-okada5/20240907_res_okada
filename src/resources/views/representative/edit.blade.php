<body>
    <h1>店舗編集</h1>
    <!-- 店舗情報の更新フォーム -->
    <form action="{{ route('stores.update', ['store' => $store->id]) }}" method="POST">
        @csrf <!-- CSRFトークン -->
        @method('PUT') <!-- HTTPメソッドのオーバーライド -->

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

        <!-- 更新ボタン -->
        <button type="submit">更新</button>
    </form>

    <!-- 画像アップロードフォーム -->
    <form action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data">
        @csrf <!-- CSRFトークン -->

        <div>
            <label for="image">画像を選択:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <!-- アップロードボタン -->
        <button type="submit">アップロード</button>
    </form>

    <!-- アップロードされた画像の表示 -->
    @if(isset($imagePath))
        <div>
            <label for="uploaded-image">アップロードされた画像:</label>
            <img src="{{ asset('storage/' . $imagePath) }}" alt="Uploaded Image">
        </div>
    @endif

    <!-- 画像削除フォーム -->
    <form action="{{ route('delete.image', ['id' => $store->id]) }}" method="POST">
        @csrf <!-- CSRFトークン -->
        @method('DELETE') <!-- HTTPメソッドのオーバーライド -->

        <!-- 画像削除ボタン -->
        <button type="submit">画像を削除</button>
    </form>
</body>
</html>

