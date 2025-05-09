<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
    use HasFactory;

    // Các trường có thể gán hàng loạt
    protected $fillable = ['order_id', 'product_name', 'price', 'quantity'];

    // Định nghĩa quan hệ với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
