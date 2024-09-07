@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/store_review.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<!-- 口コミ新規投稿 -->
<main class="main">
    <div class="container-wrapper">
        <!-- 店舗詳細 -->
        <div class="container-store">
            <h3 class="store-info">今回のご利用はいかがでしたか？</h3>
            <div class="container-storebox">
                <img src="{{ $store->image_url }}" alt="{{ $store->name }}" class="store-image">
                <h3 class="store-name">{{ $store->name }}</h3>
                <div class="store-area-genre">
                    <p class="store-area">#{{ $store->area->area }}</p>
                    <p class="store-genre">#{{ $store->genre->genre }}</p>
                </div>
                <div class="container-button">
                    <button class="detail-button" onclick="location.href='/store_detail/{{ $store->id }}'">詳しく見る</button>
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
        </div>
        
        <!-- 口コミ投稿フォーム -->
        <div class="review-container">
            @if (Auth::check())
                <form action="{{ route('reviews.store', $store->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="rating-form">
                        <label for="rating" class="rating">体験を評価して下さい</label>
                        <div id="star-rating" class="star-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star" data-value="{{ $i }}">&#9733;</span>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" required>
                        @error('rating')
                            <span class="validation-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <h3 class="comment">口コミを投稿</h3>
                    <div class="comment-form">
                        <label for="comment"></label>
                        <textarea name="comment" id="comment" class="custom-textarea" rows="3" maxlength="400" placeholder="カジュアルな夜のお出かけにおすすめのスポット" oninput="updateCharCount()" required>{{ old('comment') }}</textarea>
                        <div class="char-count">
                            <span id="charCount">0</span>/400 （最大文字数）
                        </div>
                    </div>
                    @error('comment')
                        <span class="validation-error">{{ $message }}</span>
                    @enderror
                    <div class="image-form">
                        <h3 class="review-image">画像の追加</h3>
                        <label for="image" class="hidden-label">画像の追加</label>
                        <div id="drop-area" class="drop-area">
                            <p>ここに画像をドロップまたはクリックして選択</p>
                            <input type="file" name="image" id="image" class="file-input" accept="image/jpeg, image/png" style="display: none;">
                            <div id="image-preview" class="image-preview">
                                <img id="preview-img" src="" alt="Preview" style="display: none;">
                            </div>
                        </div>
                        @error('image')
                            <span class="validation-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="submit-button-container">
                        <button type="submit" class="submit-button">口コミを投稿</button>
                    </div>
                </form>
            @else
                <p>口コミを投稿するにはログインが必要です</p>
                <div>
                    <button onclick="location.href='/login'">ログイン</button>
                    <button onclick="location.href='/register'">新規登録</button>
                </div>
            @endif
        </div>
    </div>   
</main>
@endsection
@section('scripts')
<!-- CSRFトークン -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="/js/index_script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // スター評価の処理
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;
            updateStarSelection(rating);
        });
    });

    function updateStarSelection(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

    // 文字数カウントの処理
    function updateCharCount() {
        const textarea = document.getElementById('comment');
        const charCount = document.getElementById('charCount');
        charCount.textContent = textarea.value.length;
    }

    updateCharCount();

    const textarea = document.getElementById('comment');
    if (textarea) {
        textarea.addEventListener('input', updateCharCount);
    } else {
        console.error('Textarea with ID comment is null');
    }

    // ドロップエリアとファイル入力の処理
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('image');
    const previewImg = document.getElementById('preview-img');
    const imagePreview = document.getElementById('image-preview');

    if (dropArea && fileInput) {
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        dropArea.addEventListener('dragenter', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                displayImage(files[0]);
            }
        });

        // ファイルが選択されたら表示する処理
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                displayImage(fileInput.files[0]);
            }
        });

        // 画像を表示する関数
        function displayImage(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block'; // 画像を表示
                imagePreview.style.opacity = '1'; // プレビューを表示
            };
            reader.readAsDataURL(file);
        }
    } else {
        console.error('dropArea or fileInput is null');
    }
});
</script>
@endsection