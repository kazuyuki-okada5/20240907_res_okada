@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/store_edit.css') }}">
<!-- 口コミ編集 -->
<main class="main">
    <h3 class="review-page">口コミ編集ページ</h3>
    <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data" class="review-edit-form">
        @csrf
        @method('PUT')
        <div class="rating-form">
            <label for="rating" class="rating-label">評価:</label>
            <div id="star-rating" class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}" style="color: gray;">&#9733;</span>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="{{ old('rating', $review->rating) }}" required>
            @error('rating')
                <span class="validation-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="comment-form">
            <label for="comment" class="comment">コメント:</label><br>
            <textarea name="comment" class="comment-text-form" id="comment" rows="3" required>{{ old('comment', $review->comment) }}</textarea>
            <div class="char-count">
                <span id="charCount">0</span>/400 （最大文字数）
            </div>
            @error('comment')
                <span class="validation-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="image-form">
            <label for="image" class="image-label">画像:</label>         
            <div id="drop-area" class="drop-area">
                <p class="drop-guid">ここに画像をドロップまたはクリックして選択</p>
                <input type="file" name="image" id="image" class="file-input" accept="image/jpeg, image/png" style="display: none;">
                <div id="image-preview" class="image-preview">
                    <img id="preview-img" src="" alt="Preview" style="display: none;">                    
                </div>
            </div>
            @if ($review->image_path)
                <p class="before-image">変更前の画像:</p>
                <img src="{{ asset('storage/' . $review->image_path) }}" class="before-preview" alt="Review Image" style="max-width: 200px;">                
            @endif
            @error('image')
                <span class="validation-error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="submit-button">更新する</button>
    </form>
</main>
@endsection
@section('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="/js/index_script.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');
    const currentRating = ratingInput.value;

    // 初期評価の星の色を更新
    updateStarSelection(currentRating);

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
                star.style.color = 'gold';
            } else {
                star.style.color = 'gray';
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

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                displayImage(fileInput.files[0]);
            }
        });

        function displayImage(file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                imagePreview.style.opacity = '1';
            };
            reader.readAsDataURL(file);
        }
    } else {
        console.error('dropArea or fileInput is null');
    }
});
</script>
@endsection