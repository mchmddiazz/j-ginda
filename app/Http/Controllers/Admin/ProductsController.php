<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
        if(request()->ajax()) {
            $data = Product::orderBy('id', 'DESC')
            ->where('status', 1)
            ->get();
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="#" class="btn btn-info" data-id="'.$data->id.'" data-bs-toggle="modal" data-bs-target="#modelId" id="buton_edit"><i class="fa-solid fa-edit me-2"></i> Edit</a> '.
                    '<a href="#" class="btn btn-danger" data-id="'.$data->id.'" id="buton_hapus"><i class="fa-solid fa-trash me-2"></i> Hapus</a>';
                })
                // ->addColumn('price', function($data){
                //     return 'Rp. '.number_format($data->price, 0, ',', '.').'';
                // })
                // ->addColumn('priceDisc', function($data){
                //     return 'Rp. '.number_format($data->priceDisc, 0, ',', '.').'';
                // })
                ->addColumn('quantity', function($data){
                    if ($data->quantity <= 5) {
                        return 'Stok rendah, tersisa '.$data->quantity.' stok';
                    } else {
                        return ''.$data->quantity.' stok tersedia';
                    }
                })
                //  ->addColumn('slideActive', function($data){
                //     if ($data->slideActive == 0) {
                //         return '<span class="badge badge-danger">Non Banner</span>';
                //     } elseif($data->slideActive == 1) {
                //         return ' <span class="badge badge-success">Banner</span>';
                //     }
                // })
                ->addColumn('image', function($data){
                    return '<img src="'.asset('product').'/'.$data->image.'" alt="Site Logo" style="height: 95px;">';
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
            'name'          => $request->name,
            'price'         => str_replace(".", "", $request->price),
            'priceDisc'     => str_replace(".", "", $request->priceDisc),
            'description'   => $request->description,
            'quantity'      => $request->quantity,
            'weight'        => $request->weight,
            'slideActive'   => $request->slideActive,
            'status'        => 1
        ];

        if ($files = $request->file('image')) {
            // update product
            //delete old file
            \File::delete('product/'.$request->hidden_image);
          
            //insert new file
            $destinationPath = 'product/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $details['image'] = "$profileImage";
         }
         $product   =   Product::updateOrCreate(['id' => $productId], $details);  
           
         return response()->json($product);
        }
    }

    function edit($id)
    {
        $where = array('id' => $id);
        $product  = Product::where($where)->first();
    
        return response()->json($product);
    }

    function destroy($id)
    {
        $data = Product::where('id',$id)->first(['image']);
        \File::delete('product/'.$data->image);

        $products = Product::where('id', $id)->first();
        $products->status = 0;
        $products->save();
    
        return response()->json($products);
    }
}
