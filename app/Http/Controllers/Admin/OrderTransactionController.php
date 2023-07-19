<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderTransactionController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        if(!auth()->user()->hasRole(RoleEnum::ADMINISTRATOR())){
            abort(403);
        }
        $type = request()->query("type", "in");
        $data = [
            "transactions" => OrderItem::where("type", $type)->orderBy("created_at", "desc")->paginate(15)
        ];
        return response()->view("admin.order-transactions.index", $data);
    }
}
