<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderTransactionController extends Controller
{
    public function index()
    {
        $data = [
            "transactions" => OrderItem::paginate(15)
        ];
        return response()->view("admin.order-transactions.index", $data);
    }
}
