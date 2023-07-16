<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use \PDF;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
class InvoiceController extends Controller
{
    function generate($idOrder)
    {
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
        ->where('orders.id', $idOrder)
        ->get();

        $namaOrder = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.name as name_user',
            'orders.*',
            'order_items.price',
            'products.name as name_product'
        )
        ->where('orders.id', $idOrder)
        ->first();

        
        $customPaper = array(0,0,650,1400);
        $pdf = PDF::loadView('landingPage.orders.invoice.index',['order' => $order, 'orderGet' => $namaOrder])->setPaper($customPaper,'portrait');
        
        $path = public_path('pdf/invoice');

        $filename = $namaOrder->order_number . '-' . $namaOrder->first_name .' '. $namaOrder->last_name . '.' . 'pdf';
        $pdf->save($path . '/' . $filename);

        $createPdf = new Invoice;
        $createPdf->fileName = $filename;
        $createPdf->user_id = Auth::user()->id;
        $createPdf->order_id = $idOrder;
        $createPdf->path = $path;
        $createPdf->save();

        $pdf = public_path('pdf/invoice/'.$filename);
        return response()->download($pdf);

    }
    function generateAdmin($idOrder)
    {
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
        ->where('orders.id', $idOrder)
        ->get();

        $namaOrder = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select(
            'users.name as name_user',
            'orders.*',
            'order_items.price',
            'products.name as name_product'
        )
        ->where('orders.id', $idOrder)
        ->first();

        
        $customPaper = array(0,0,650,1400);
        $pdf = PDF::loadView('landingPage.orders.invoice.index',['order' => $order, 'orderGet' => $namaOrder])->setPaper($customPaper,'portrait');
        
        $path = public_path('pdf/invoice');

        $filename = $namaOrder->order_number . '-' . $namaOrder->first_name .' '. $namaOrder->last_name . '.' . 'pdf';
        $pdf->save($path . '/' . $filename);

        $createPdf = new Invoice;
        $createPdf->fileName = $filename;
        $createPdf->user_id = $namaOrder->user_id;
        $createPdf->order_id = $idOrder;
        $createPdf->path = $path;
        $createPdf->save();

        $pdf = public_path('pdf/invoice/'.$filename);
        return response()->download($pdf);

    }
}
