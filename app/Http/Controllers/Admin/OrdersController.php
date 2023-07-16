<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Validator,Redirect,Response,File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
class OrdersController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {
            $data = Order::orderBy('id', 'DESC')
            ->get();
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="'.url('admin/orders/show', base64_encode($data->id)).'" class="btn btn-dark" id="button_detail"><i class="fa-solid fa-eye me-2"></i> Detail</a>'.'&nbsp;'.'<a href="#" class="btn btn-info" data-id="'.$data->id.'" id="buttonUpdate"><i class="fa-solid fa-calendar me-2"></i> Expired</a>'.'&nbsp;'.'<a href="#" class="btn btn-danger" data-id="'.$data->id.'" id="buttonCancel"><i class="fa-solid fa-close me-2"></i> Batalkan</a>';
                })

                ->addColumn('grand_total', function($data){
                    return 'Rp. '.number_format($data->grand_total, 0, ',', '.').'';
                })
                 ->addColumn('payment_status', function($data){
                    if ($data->payment_status == 1) {
                        return '<span class="badge badge-info">Menunggu Pembayaran</span>'. '&nbsp'.'<a href="#" class="btn btn-success" data-id="'.$data->id.'" id="buttonAccept"><i class="fa-solid fa-check me-2"></i> Konfirmasi Pembayaran</a>';;
                    } elseif($data->payment_status == 2) {
                        return '<span class="badge badge-success">Sudah Dibayar</span>'. '&nbsp'. ' <a href="#" data-id="'.$data->id.'" class="btn btn-primary" data-order="'.$data->order_number.'" id="buton_generate"><i class="fas fa-download"></i> Invoice</a>';
                    } elseif($data->payment_status == 5) {
                        return '<span class="badge badge-info">Bayar Cod</span>'. '&nbsp'. ' <a href="#" data-id="'.$data->id.'" class="btn btn-primary" data-order="'.$data->order_number.'" id="buton_generate"><i class="fas fa-download"></i> Invoice</a>'. '&nbsp'. '<a href="#" class="btn btn-success" data-id="'.$data->id.'" id="buttonAccept"><i class="fa-solid fa-check me-2"></i> Konfirmasi Pembayaran</a>';
                    } elseif($data->payment_status == 4) {
                        return '<span class="badge badge-danger">Dibatalkan</span>';
                    } elseif($data->payment_status == 6) {
                        return '<span class="badge badge-success">Sedang Dikirim</span>';
                    } else {
                        return '<span class="badge badge-danger">Kadaluarsa</span>';
                    }
                })
                ->addColumn('created_at', function($data){
                    return Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y');
                 })
                 ->addColumn('name', function($data){
                    return $data->first_name .' '. $data->last_name;
                 })

                ->rawColumns(['action', 'grand_total', 'payment_status', 'name', 'created_at'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.orders.index');
    }

    function show($id)
    {
        $data['order'] = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('province_seconds', 'orders.province_id', '=', 'province_seconds.province_id')
        ->join('city_seconds', 'orders.regency_id', '=', 'city_seconds.city_id')
        ->select(
            'orders.*',
            'order_items.price',
            'products.name as name_product',
            'order_items.quantity as quantity_item',
            'products.description as descriptionn',
            'products.priceDisc as price_products',
            'users.id as id_user',
            'users.email as email_user',
            'users.name as name_user',
            'province_seconds.name as name_province',
            'city_seconds.name as name_regencies'
        )
        ->where('orders.id', base64_decode($id))
        ->get();

        $data['orderGet'] = Order::whereId(base64_decode($id))->first();

        // return response()->json($data);
        return view('admin.orders.show', $data);
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
