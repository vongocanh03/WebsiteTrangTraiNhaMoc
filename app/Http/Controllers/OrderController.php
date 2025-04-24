<?php

// app/Http/Controllers/OrderController.php
// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function submitOrder(Request $request)
    {
        // Validate dữ liệu đầu vào
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:255', // Đảm bảo trường này là bắt buộc
            'reservation_date' => 'required|date_format:d/m/Y', // Validate định dạng ngày dd/mm/yyyy
            'arrival_time' => 'required|date_format:H:i', // Validate giờ theo định dạng H:i (24h)    
            'guest_count' => 'required|integer|min:1', // Số lượng người
            'cart' => 'required|array', // Giỏ hàng bắt buộc
        ]);

        try {
            // Chuyển đổi ngày từ định dạng dd/mm/yyyy sang Y-m-d
            $reservationDate = Carbon::createFromFormat('d/m/Y', $data['reservation_date'])->format('Y-m-d');
            $arrivalTime = Carbon::createFromFormat('H:i', $data['arrival_time'])->format('H:i:s');

            // Lưu thông tin đơn hàng vào bảng orders
            $order = Order::create([
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'reservation_date' => $reservationDate, // Ngày đặt bàn đã chuyển đổi
                'arrival_time' => $arrivalTime, // Giờ dự kiến đến đã chuyển đổi
                'guest_count' => $data['guest_count'], // Số lượng người
            ]);

            // Lưu thông tin sản phẩm vào bảng order_items
            foreach ($data['cart'] as $item) {
                $order->orderItems()->create([
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Gửi email xác nhận đơn hàng đến email cá nhân
            Mail::to('anhhung05032003@gmail.com')->send(new OrderConfirmation($order));

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Lưu lỗi vào log để kiểm tra chi tiết
            \Log::error('Error submitting order:', [
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'order_data' => $data // Thêm dữ liệu đơn hàng để dễ dàng kiểm tra
            ]);

            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
