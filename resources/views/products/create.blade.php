<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
</head>
<body>
    <h1>Thêm Sản Phẩm Mới</h1>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Tên Sản Phẩm:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" required>

        <label for="quantity">Số Lượng:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="category_id">Danh Mục:</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="image">Hình Ảnh:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">Thêm Sản Phẩm</button>
    </form>
</body>
</html>
