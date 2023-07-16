<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckOngkirController extends Controller
{
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        return view('ongkir', compact('provinces'));
    }
    
    
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function get_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'         => 126, // ID kota/kabupaten asal
            // 'originType'     => 'city',
            'destination'    => $request->city_destination, // ID kota/kabupaten tujuan
            // 'destinationType'=> 'city',
            'weight'         => $request->weight, // berat barang dalam gram
            'courier'        => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();  

        return response()->json($cost, 201);

    }

    function getTotalOngkir(Request $request)
    {
        $total = $request->layanan + \Cart::session(Auth::user()->id)->getTotal();
        return response()->json(['ongkir' => "Rp. " . number_format($request->layanan, 0, ",", "."), 'totalKirim' => "Rp. " . number_format($total, 0, ",", "."), 'totalpayment' => $total, 'ongkirPayment' => $request->layanan],201);
    }
}
