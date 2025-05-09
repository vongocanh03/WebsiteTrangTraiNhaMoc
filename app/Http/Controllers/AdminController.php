<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderItem;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function thongKeMonAn(Request $request)
    {
        $ngay = $request->input('ngay') ?? Carbon::today()->format('Y-m-d');

        $tongGaNuong = OrderItem::whereHas('order', function ($query) use ($ngay) {
                $query->whereDate('reservation_date', $ngay)
                      ->where('status', 'confirmed'); // Chỉ đơn đã xác nhận
            })
            ->where('product_name', 'like', '%gà nướng%')
            ->sum('quantity');

        return view('admin.thong-ke', [
            'ngay' => $ngay,
            'tongGaNuong' => $tongGaNuong
        ]);
    }
}
