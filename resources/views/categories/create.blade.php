<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Danh Mục</title>
</head>
<body>
    <h1>Thêm Danh Mục Mới</h1>
    
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Tên Danh Mục:</label>
        <input type="text" name="name" id="name" required>
        <button type="submit">Lưu Danh Mục</button>
    </form>
</body>
</html>
