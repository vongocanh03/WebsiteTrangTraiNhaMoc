<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê món ăn - Nhà Mộc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Mobile-first */
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #2c2c2c;
        }

        .container {
            padding: 1rem;
        }

        h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #14532d;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        input[type="date"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            background-color: #f9fafb;
            margin-bottom: 1rem;
        }

        button.btn {
            background-color: #15803d;
            color: white;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        button.btn:hover {
            background-color: #166534;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            margin-top: 1rem;
            background-color: white;
            border-radius: 6px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        .table th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: 600;
        }

        .alert {
            background-color: #fef3c7;
            border-left: 4px solid #facc15;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #92400e;
            margin-top: 1rem;
        }

        @media (min-width: 768px) {
            .container {
                max-width: 700px;
                margin: 0 auto;
            }

            h4 {
                font-size: 1.5rem;
            }

            input[type="date"] {
                max-width: 250px;
                display: inline-block;
                margin-right: 0.5rem;
            }

            form button {
                display: inline-block;
                vertical-align: middle;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Thống kê tất cả món ăn theo ngày</h4>

        <form method="GET" action="{{ url('/thongke') }}" class="mb-3">
            <label for="ngay">Chọn ngày:</label>
            <input type="date" id="ngay" name="ngay" value="{{ $ngay }}">
            <button type="submit" class="btn">Xem</button>
        </form>

        @if ($monAn->isEmpty())
            <div class="alert">
                Không có món nào được đặt trong ngày {{ \Carbon\Carbon::parse($ngay)->format('d/m/Y') }}.
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Món ăn</th>
                        <th>Số lượng đã đặt</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monAn as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->tong_so_luong }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
