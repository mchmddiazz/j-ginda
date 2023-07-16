<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    function index(Request $request)
    {
        if (request()->ajax()) {
            $data = Product::orderBy('id', 'DESC')
                ->where('status', 1)
                ->get();

            return DataTables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#" class="btn btn-info" data-id="' . $data->id . '" data-bs-toggle="modal" data-bs-target="#modelId" id="buton_edit"><i class="fa-solid fa-edit me-2"></i> Edit</a> ' .
                        '<a href="#" class="btn btn-danger" data-id="' . $data->id . '" id="buton_hapus"><i class="fa-solid fa-trash me-2"></i> Hapus</a>';
                })
                ->addColumn('quantity', function ($data) {
                    $quantity = $data->quantity <= $data->quantity_threshold ?
                        "Stok rendah, tersisa $data->quantity stok" :
                        "$data->quantity stok tersedia";

                    return $quantity;
                })
                ->addColumn("quantity_threshold", function ($data) {
                    return "$data->quantity_threshold pcs";
                })
                ->addColumn("weight", function ($data) {
                    return "$data->weight grams";
                })
                ->addColumn('image', function ($data) {
                    return '<img src="' . asset('product') . '/' . $data->image . '" alt="Site Logo" style="height: 95px;">';
                })
                ->rawColumns(['action', 'image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.product.index');
    }


    function store(Request $request)
    {
        if (str_replace(".", "", $request->price) < str_replace(".", "", $request->priceDisc)) {
            return response()->json(['status' => 3], 201);
        } else {
            date_default_timezone_set('Asia/Jakarta');

            request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $productId = $request->product_id;
            $details = [
                'name' => $request->name,
                'price' => str_replace(".", "", $request->price),
                'priceDisc' => str_replace(".", "", $request->priceDisc),
                'description' => $request->description,
                'quantity' => $request->quantity,
                'quantity_threshold' => $request->quantity_threshold,
                'weight' => $request->weight,
                'slideActive' => $request->slideActive,
                'status' => 1
            ];

            if ($files = $request->file('image')) {
                // update product
                //delete old file
                \File::delete('product/' . $request->hidden_image);

                //insert new file
                $destinationPath = 'product/'; // upload path
                $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $details['image'] = "$profileImage";
            }
            try {
                DB::beginTransaction();
                $product = Product::updateOrCreate(['id' => $productId], $details);
                OrderItem::create([
                    "product_id" => $product->id,
                    "quantity" => $request->quantity,
                    "type" => 0
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }


            return response()->json($product);
        }
    }

    function edit($id)
    {
        $where = array('id' => $id);
        $product = Product::where($where)->first();

        return response()->json($product);
    }

    function destroy($id)
    {
        $data = Product::where('id', $id)->first(['image']);
        \File::delete('product/' . $data->image);

        $products = Product::where('id', $id)->first();
        $products->status = 0;
        $products->save();

        return response()->json($products);
    }
}
