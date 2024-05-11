<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant reservation service</title>
  <!-- CSSファイルを読み込む -->
  <link rel="stylesheet" href="/css/common.css">
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <!-- ロゴとハンバーガーアイコンを同じレベルに配置 -->
        <div class="header__logo-container">
          <!-- ハンバーガーメニューアイコン -->
          <div class="header__hamburger" onclick="toggleMenu()">
            &#9776; <!-- ハンバーガーアイコンのUnicode文字 -->
          </div>
          <!-- ×アイコン -->
          <div class="header__close" onclick="toggleMenu()">
            &times; <!-- ×アイコンのUnicode文字 -->
          </div>
          <!-- 登録エリアを表示させて選択できるボタン -->
          <!-- メニュー -->
          <nav class="header__menu" id="headerMenu">
            <ul class="header-nav">
              <!-- メニューアイテム -->
              <li class="header-nav__item" id="homeItem">
                <a class="header-nav__link" href="/stores">Home</a>
              </li>
              <li class="header-nav__item" id="mypageItem">
                <a class="header-nav__link" href="{{ route('favorite.index') }}">マイページ</a>
              </li>
              <li class="header-nav__item" id="logoutItem" style="display: none;">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf <!-- CSRFトークンの追加 -->
</form>

<!-- ログアウトリンク -->
<a id="logoutLink" class="header-nav__link" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
  ログアウト
</a>
              </li>
              <li class="header-nav__item" id="registrationItem">
                <a class="header-nav__link" href="/registration">Registration</a>
              </li>
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

  <main>
    <!-- コンテンツ -->
  </main>

  <script>
    var isLoggedIn = <?php echo Auth::check() ? 'true' : 'false'; ?>;
  </script>
  <script src="/js/script.js"></script>

  <main>
    @yield('content')
  </main>
  @yield('scripts')
</body>

</html>
