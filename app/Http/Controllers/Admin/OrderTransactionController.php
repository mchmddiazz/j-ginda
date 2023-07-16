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
            "transactions" => OrderItem::orderBy("created_at", "desc")->paginate(15)
        ];
        return response()->view("admin.order-transactions.index", $data);
    }
}
