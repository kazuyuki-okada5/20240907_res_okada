<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant reservation service</title>
  <!-- 共通のCSSファイルを読み込む -->
  <link rel="stylesheet" href="/css/common.css">
</head>

<body>
  <!-- ヘッダー -->
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <!-- ロゴとハンバーガーアイコン -->
        <div class="header__logo-container">
          <!-- ハンバーガーメニューアイコン -->
          <div class="header__hamburger" onclick="toggleMenu()">
            &#9776; <!-- ハンバーガーアイコンのUnicode文字 -->
          </div>
          <!-- メニューを閉じるアイコン -->
          <div class="header__close" onclick="toggleMenu()">
            &times; <!-- メニュー閉じるアイコンのUnicode文字 -->
          </div>
          <!-- メニュー -->
          <nav class="header__menu" id="headerMenu">
            <ul class="header-nav">
              <!-- ホーム -->
              <li class="header-nav__item" id="homeItem">
                <a class="header-nav__link" href="/stores">Home</a>
              </li>
              <!-- マイページ -->
              <li class="header-nav__item" id="mypageItem">
                <a class="header-nav__link" href="{{ route('favorite.index') }}">マイページ</a>
              </li>
              <!-- ログアウト -->
              <li class="header-nav__item" id="logoutItem" style="display: none;">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf <!-- CSRFトークンの追加 -->
                </form>
                <a id="logoutLink" class="header-nav__link" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                  ログアウト
                </a>
              </li>
              <!-- 会員登録 -->
              <li class="header-nav__item" id="registrationItem">
                <a class="header-nav__link" href="/registration">Registration</a>
              </li>
              <!-- ログイン -->
              <li class="header-nav__item" id="loginItem">
                <a class="header-nav__link" href="/login">Login</a>
              </li>
            </ul>
          </nav>
          <!-- Reseロゴ -->
          <h1 class="header__logo">
            Rese
          </h1>
        </div>
      </div>
    </div>
  </header>

  <!-- メインコンテンツ -->
  <main>
    @yield('content')
  </main>

  <!-- ログイン状態をJavaScriptに渡す -->
  <script>
    var isLoggedIn = <?php echo Auth::check() ? 'true' : 'false'; ?>;
  </script>
  <!-- 共通のJavaScriptファイルを読み込む -->
  <script src="/js/script.js"></script>

  <!-- 追加のスクリプト -->
  @yield('scripts')
</body>

</html>

