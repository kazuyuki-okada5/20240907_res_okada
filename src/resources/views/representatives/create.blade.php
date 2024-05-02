<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規代表者作成</title>
</head>

<body>
    <h1>新規代表者作成</h1>
    <form action="{{ route('representatives.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email">
        </div>
        <div>
            <label for="password">パスワード:</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <button type="submit">作成</button>
        </div>
    </form>
</body>

</html>