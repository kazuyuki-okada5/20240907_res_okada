<!-- resources/views/manager/create.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Representative</title>
</head>
<body>
    <h1>Create Representative</h1>
    <form action="{{ route('manager.create') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>