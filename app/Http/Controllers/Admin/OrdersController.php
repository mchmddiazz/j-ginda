<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\UpdateStatusPaymentRequest;
use App\Services\Admin\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
class OrdersController extends Controller
{

    /**
     * @param OrderService $service
     * @return Response
     */
    public function index(OrderService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);
        return response()->view('admin.orders.index');
    }


    /**
     * @param OrderService $service
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function show(OrderService $service, int $id):Response|RedirectResponse
    {
        $response = $service->getDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        viewShare($response);
        return response()->view("admin.orders.show");
    }


    /**
     * @param OrderService $service
     * @param int $id
     * @param string $status
     * @return RedirectResponse
     */
    public function updatePaymentStatus(OrderService $service, int $id, string $status, UpdateStatusPaymentRequest $request):RedirectResponse
    {
        $response = $service->updateStatusPayment($id, $status, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.orders.index")->with("success", ucfirst("Update status pembayaran berhasil !"));
    }


    function updateStatus($id)
    {
        $order = Order::where('id', $id)->first();
        $order->payment_status = 3;
        $order->save();

        
        return response()->json($order);
    }

    function updateCancel($id)
    {
        $order = Order::where('id', $id)->first();
        $order->payment_status = 4;
        $order->save();

        
        return response()->json($order);
    }

    function updateAccept($id)
    {
        $order = Order::where('id', $id)->first();
        $order->payment_status = 2;
        $order->save();
        return response()->json($order);
    }

    function shipping(Request $request)
    {
        $orders = Order::whereId($request->order_id)->first();
        $orders->tracking_number = $request->tracking_number;
        $orders->payment_status = 6;
        $orders->save();


        $order = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.*',
            'order_items.price',
            'products.name as name_product',
            'order_items.quantity as quantity_item',
            'products.description as descriptionn',
            'products.priceDisc as price_products'
        )
        ->where('orders.id', $request->order_id)
        ->get();

        $namaOrder = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'orders.*',
            'order_items.price',
            'products.name as name_product'
        )
        ->where('orders.id', $request->order_id)
        ->first();

        $orderItem = OrderItem::where('order_id', $request->order_id)->first();
                
        $product = Product::whereId($orderItem->product_id)->first();
        $stok = $product->quantity - $orderItem->quantity;
        $product->quantity = $stok;
        $product->save();

        $user = Order::where('id', $request->order_id)->first();
        $email = $user->email;
        Mail::send('landingPage.orders.invoice.index', ['email' => $email, 'order' => $order, 'orderGet' => $namaOrder], function ($message)

        use ($email, $order, $namaOrder) {
            $message->to($email)->subject('Pesanan Anda Dikirim');
        });

        return response()->json(['status' => 1], 201);
    }
}
