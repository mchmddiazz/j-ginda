<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AboutUs;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    function index(Request $request)
    {
        if($request->user()->hasRole('admin')) {

            $data = [
                'visitor'   => DB::table('visitors')->count(),
                'revenue'   => DB::table('orders')->select(DB::raw("SUM(grand_total) as count"))->whereIn('payment_status', [2,6])->orderBy("created_at")->groupBy(DB::raw("year(created_at)"))->get(),
                'orders'    => DB::table('orders')->count(),
                'customer'  => DB::table('role_users')->join('users', 'role_users.user_id', '=', 'users.id')
                                ->join('roles', 'role_users.role_id', '=', 'roles.id')
                                 ->where('roles.name', 'user')->count()
            ];

            return view('admin.dashboard', $data);
        } else {
            abort(403);
        }
    }
}
