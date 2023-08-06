<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfflineStoreController extends Controller
{
    public function create()
    {
        viewShare([
            "products" => (new ProductRepository())->getAllData()
        ]);
        return response()->view("admin.offline-store.create");
    }

    public function store()
    {
        $grandTotal = 0;

        foreach (request()->get("product_ids") as $key => $product){
           $grandTotal += request()->get("quantity")[$key] * Product::find($product)->price;
        }
        $order = Order::create([
            "order_number" => 'ORD-' . strtoupper(uniqid()),
            "user_id" => Auth::id(),
            "status" => OrderStatus::COMPLETED(),
            "type" => "offline",
            "grand_total" => $grandTotal,
            "item_count" => count(request()->get("product_ids")),
            "payment_status" => PaymentStatusEnum::PAID()
        ]);

        foreach (request()->get("product_ids") as $key => $product){
            OrderItem::create([
                "code" => strtoupper(uniqid("OUT-")),
                'product_id' => $product,
                'quantity' => request()->get("quantity")[$key],
                'price' => Product::find($product)->price,
                "order_id" => $order->id
            ]);

            $product = Product::find($product);
            $product->quantity -= request()->get("quantity")[$key];
            $product->save();
        }

        return redirect()->back()->with("success", "Transaksi berhasil");
    }
}
