<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'customer_phone', 'reservation_date', 'arrival_time', 'guest_count'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
