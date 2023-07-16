<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
use Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {
 
        $params = [
            'transaction_details' => [
                'order_id' => $this->order->order_number,
                'gross_amount' => $this->order->grand_total,
            ],
            'customer_details' => [
                'first_name' => $this->order->first_name,
                'last_name' => $this->order->last_name,
                'email' => Auth::user()->email,
                'phone_number' => $this->order->phone_number
            ]
        ];
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}