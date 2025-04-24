<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sản Phẩm</title>
</head>
<body>
    <h1>Sửa Sản Phẩm</h1>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Tên Sản Phẩm:</label>
        <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        
        <label for="price">Giá:</label>
        <input type="number" name="price" id="price" value="{{ $product->price }}" required>

        <label for="quantity">Số Lượng:</label>
        <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" required>

        <label for="category_id">Danh Mục:</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <label for="image">Hình Ảnh:</label>
        <input type="file" name="image" id="image">

        <button type="submit">Cập Nhật Sản Phẩm</button>
    </form>
</body>
</html>
