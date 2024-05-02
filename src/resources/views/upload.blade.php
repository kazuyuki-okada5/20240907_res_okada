
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
<form action="{{ route('stores.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- 他の入力フィールドも追加 -->
    <input type="file" name="image">
    <input type="text" name="image_url"> <!-- image_url の入力フィールドを追加 -->
    <button type="submit">Submit</button>
</form>
</body>
</html>
