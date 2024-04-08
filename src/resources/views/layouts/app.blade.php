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
                                <a class="header-nav__link" href="/">Home</a>
                            </li>
                            <li class="header-nav__item" id="mypageItem">
    <a class="header-nav__link" href="{{ route('favorite.index') }}">マイページ</a>
</li>
                            <li class="header-nav__item" id="logoutItem" style="display: none;">
                                <a class="header-nav__link" href="/logout">ログアウト</a>
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
                    <a class="header__logo" href="/">
                        Rese
                    </a>
                    
                    </div>
                </div>
            </div>
        </div>
    </header>

  <main>
    <!-- コンテンツ -->
  </main>

  <script>
    // ページが読み込まれたときに実行される関数
    window.onload = function () {
        // ログイン状態に応じてメニュー項目を表示または非表示にする
        updateMenu();
    };

    // ログイン状態が変更された場合に呼び出される関数
    function updateMenu() {
        var isLoggedIn = {{ Auth::check() ? 'true' : 'false' }}; // ログイン状態を示す変数

        // ログイン状態に応じてメニュー項目を表示または非表示にする
        if (isLoggedIn) {
        document.getElementById('homeItem').style.display = 'block';
        document.getElementById('mypageItem').style.display = 'block';
        document.getElementById('logoutItem').style.display = 'block';
        document.getElementById('registrationItem').style.display = 'none';
        document.getElementById('loginItem').style.display = 'none';
      } else {
        document.getElementById('homeItem').style.display = 'block';
        document.getElementById('mypageItem').style.display = 'none';
        document.getElementById('logoutItem').style.display = 'none';
        document.getElementById('registrationItem').style.display = 'block';
        document.getElementById('loginItem').style.display = 'block';
      }
    };

    // メニューの表示状態をトグルする関数
    function toggleMenu() {
      var menu = document.getElementById('headerMenu');
      menu.classList.toggle('show');
      var hamburgerIcon = document.querySelector('.header__hamburger');
      var closeIcon = document.querySelector('.header__close');
      hamburgerIcon.style.display = (menu.classList.contains('show')) ? 'none' : 'block';
      closeIcon.style.display = (menu.classList.contains('show')) ? 'block' : 'none';
    }
// JavaScript
function handleKeyDown(event) {
  if (event.key === "Enter") {
    search(); // Enterキーが押されたら検索を実行
  }
}

function search() {
  var keyword = document.getElementById("keyword").value;
  console.log("検索キーワード：" + keyword);
  // ここで実際の検索処理を行う
}
  </script>

  <main>
    @yield('content')
  </main>
</body>

</html>