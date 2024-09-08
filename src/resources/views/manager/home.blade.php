@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/home.css">
<body>
    <div class="admin-container">
        <h2 class="admin-title">管理者用ホーム画面</h2>
        
        <!-- 店舗代表者を店舗に新規登録フォーム -->
        <div class="form-section">
            <h3 class="form-title">店舗代表者を店舗に新規登録</h3>
            <form action="{{ route('representatives.store') }}" method="POST" class="form-container">
            @csrf
                <div class="form-group">
                    <label for="name">名前:</label>
                    <input type="text" id="name" name="name" required class="input-field">
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス:</label>
                    <input type="email" id="email" name="email" required class="input-field">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">パスワード:</label>
                    <input type="password" id="password" name="password" required class="input-field">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="store_id">店舗ID:</label>
                    <select name="store_id" id="store_id" required class="input-field">
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                    @error('store_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="submit-button">新規登録</button>
            </form>
        </div>

        <!-- 店舗代表者に店舗を関連付けるフォーム -->
        <div class="form-section">
            <h3 class="form-title">店舗代表者に店舗を関連付ける</h3>
            <form action="{{ route('stores.attachRepresentative') }}" method="POST" class="form-container">
            @csrf
                <div class="form-group">
                    <label for="representative_id">店舗代表者:</label>
                    <select name="representative_id" id="representative_id" class="input-field">
                        @foreach($representatives as $representative)
                            <option value="{{ $representative->id }}">{{ $representative->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="store_id">関連付ける店舗ID:</label>
                    <select name="store_id" id="store_id" class="input-field">
                        @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="submit-button">関連付ける</button>
            </form>
        </div>

        <!-- CSVインポートフォーム -->
        <div class="form-section">
            <h3 class="form-title">CSVインポート</h3>
            <form action="{{ route('stores.import') }}" method="POST" enctype="multipart/form-data" class="form-container" id="csvForm">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- ドラッグ＆ドロップエリア -->
                <div id="drop-area" class="drop-area">
                    <p>ここにファイルをドラッグ＆ドロップするか、クリックしてファイルを選択</p>
                    <input type="file" name="file" id="fileInput" class="file-input" required hidden>
                    <!-- ファイル名を表示する要素（破線内） -->
                    <div id="file-name" class="file-name"></div>
                </div>

                <button type="submit" class="submit-button">インポート</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    @if (session('errorDetails'))
                        <ul class="error-list">
                            @foreach (session('errorDetails') as $field => $messages)
                                @foreach ($messages as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('file-name');

        // ドラッグ&ドロップエリアのスタイル変更
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false)
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // ドラッグ時のエフェクトを追加
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('highlight'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('highlight'), false);
        });

        // ファイルがドロップされた場合
        dropArea.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            fileInput.files = files;
            displayFileName(files[0].name);  // ドロップされたファイルの名前を表示
        });

        // ドロップエリアをクリックしたときにファイル選択を開く
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        // ファイル選択した場合
        fileInput.addEventListener('change', (e) => {
            const files = e.target.files;
            if (files.length > 0) {
                displayFileName(files[0].name);  // 選択されたファイルの名前を表示
            }
        });

        // ファイル名を表示する関数
        function displayFileName(fileName) {
            fileNameDisplay.textContent = "選択されたファイル: " + fileName;
        }
    </script>
</body>
@endsection