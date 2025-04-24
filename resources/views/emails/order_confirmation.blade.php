<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #006400;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
            color: #333;
        }

        td {
            background-color: #fff;
            font-size: 16px;
        }

        .table-header {
            background-color: #198754;
            color: white;
            font-weight: bold;
        }

        .phone-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .phone-link:hover {
            text-decoration: underline;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #006400;
        }
    </style>
</head>

<body>
    <h2>Xác Nhận Đơn Hàng Mới</h2>
    <p>Thông Tin Đơn Hàng Món Ăn Mới:</p>
    <table>
        <tr>
            <th>Tên Khách Hàng</th>
            <td>{{ $order->customer_name }}</td>
        </tr>
        <tr>
            <th>Số Điện Thoại</th>
            <td><a href="tel:{{ $order->customer_phone }}" class="phone-link">{{ $order->customer_phone }}</a></td>
        </tr>
        <tr>
            <th>Ngày Đặt Bàn</th>
            <td>{{ \Carbon\Carbon::parse($order->reservation_date)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Dự Kiến Giờ Ăn</th>
            <td>{{ \Carbon\Carbon::parse($order->arrival_time)->format('H:i') }}</td>
        </tr>
        <tr>
            <th>Số Lượng Người</th>
            <td>{{ $order->guest_count }}</td>
        </tr>
    </table>

    <h3>Chi Tiết Món Ăn</h3>
    <table>
        <thead class="table-header">
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }} VNĐ</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total"><strong>Tổng Tiền:
        </strong>{{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity)) }} VNĐ
    </p>
</body>

</html>