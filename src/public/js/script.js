// script.js

// ページが読み込まれたときに実行される関数
document.addEventListener('DOMContentLoaded', function() {
  // ログイン状態に応じてメニュー項目を表示または非表示にする
  updateMenu();
});

// ログイン状態が変更された場合に呼び出される関数
function updateMenu() {
 

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
}

// メニューの表示状態をトグルする関数
function toggleMenu() {
  var menu = document.getElementById('headerMenu');
  menu.classList.toggle('show');
  var hamburgerIcon = document.querySelector('.header__hamburger');
  var closeIcon = document.querySelector('.header__close');
  hamburgerIcon.style.display = (menu.classList.contains('show')) ? 'none' : 'block';
  closeIcon.style.display = (menu.classList.contains('show')) ? 'block' : 'none';
}

// Enterキーを押したときに検索を実行する関数
function handleKeyDown(event) {
  if (event.key === "Enter") {
    search(); // Enterキーが押されたら検索を実行
  }
}

// 検索を実行する関数
function search() {
  var keyword = document.getElementById("keyword").value;
  console.log("検索キーワード：" + keyword);
  // ここで実際の検索処理を行う
}

