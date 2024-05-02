<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗代表者リスト</title>
</head>

<body>
    <h1>店舗代表者リスト</h1>
    <div>
        <a href="{{ route('representatives.create') }}">新規作成</a>
    </div>
    <ul>
        <li><strong>名前</strong> - <strong>メールアドレス</strong></li>
        @foreach($representatives as $representative)
            <li>{{ $representative->name }} - {{ $representative->email }}</li>
        @endforeach
    </ul>
</body>

</html>