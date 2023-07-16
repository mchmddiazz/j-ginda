<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Services\Admin\ProductService;
use Exception;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    /**
     * @param ProductService $service
     * @return Response
     */
    public function index(ProductService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);
        return response()->view("admin.product.index");
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
