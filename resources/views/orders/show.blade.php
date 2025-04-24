<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Đơn Hàng</title>
</head>
<body>
    <h1>Chi Tiết Đơn Hàng</h1>
    
    <p><strong>Tên Khách Hàng:</strong> {{ $order->customer_name }}</p>
    <p><strong>Số Điện Thoại:</strong> {{ $order->phone }}</p>
    <p><strong>Địa Chỉ:</strong> {{ $order->address }}</p>

    <h3>Chi Tiết Sản Phẩm:</h3>
    <ul>
        @foreach(json_decode($order->order_details) as $item)
            <li>{{ $item->name }} - Số Lượng: {{ $item->quantity }} - Giá: {{ $item->price }} VNĐ</li>
        @endforeach
    </ul>
</body>
</html>
