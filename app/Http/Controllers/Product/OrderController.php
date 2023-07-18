<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Support\Facades\Auth;
use App\Models\AboutUs;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        $about_us = AboutUs::limit(1)->orderBy('created_at', 'DESC')->get();
        return view('landingPage.orders.index', compact('orders', 'about_us'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $snapToken = $order->snap_token;
        if (is_null($snapToken)) {
            // Jika snap token masih NULL, buat token snap dan simpan ke database

            $midtrans = new CreateSnapTokenService($order);
            $snapToken = $midtrans->getSnapToken();

            $order->snap_token = $snapToken;
            $order->save();
        }

        $about_us = AboutUs::limit(1)->orderBy('created_at', 'DESC')->get();
        return view('landingPage.orders.show', compact('order', 'snapToken', 'about_us'));
    }

}
