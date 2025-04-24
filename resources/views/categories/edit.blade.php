<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Danh Mục</title>
</head>
<body>
    <h1>Sửa Danh Mục</h1>
    
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Tên Danh Mục:</label>
        <input type="text" name="name" id="name" value="{{ $category->name }}" required>
        <button type="submit">Cập Nhật</button>
    </form>
</body>
</html>
