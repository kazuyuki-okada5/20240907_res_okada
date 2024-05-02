<!-- resources/views/manager/index.blade.php -->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Representatives</title>
</head>

<body>
    <h1>Representatives</h1>
    <ul>
        @foreach ($representatives as $representative)
            <li>{{ $representative->name }} - {{ $representative->email }}</li>
        @endforeach
    </ul>
</body>

</html>
