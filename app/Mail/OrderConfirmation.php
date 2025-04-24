<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    // Constructor để nhận đơn hàng
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // Định nghĩa nội dung email
    public function build()
    {
        return $this->subject('Xác Nhận Đơn Hàng Mới')
                    ->view('emails.order_confirmation') // View sẽ hiển thị trong email
                    ->with([
                        'order' => $this->order, // Truyền đơn hàng vào view
                    ]);
    }
}
