<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\AboutUs;
class CartController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        if(Auth::check())
        {
            $data = [
                'cart' => \Cart::session(Auth::user()->id)->getContent(),
                'product' => $this->productRepository->findAll(),
                'about_us' =>  AboutUs::limit(1)->orderBy('created_at', 'DESC')->get()
            ];
            return view('landingPage/cart')->with($data);
        } else {
            return redirect('/login');
        }
    }

    public function buy($id, Request $request)
    {
        if(Auth::check())
        {
            $product = Product::whereId($request->id)->first();

            if($request->quantity <= $product->quantity)
            {
                $cart = \Cart::session(Auth::user()->id)->add([
                    'id' => base64_decode($id),
                    'name' => $request->name,
                    'price' => $request->priceDisc,
                    'quantity' => $request->quantity,
                    'attributes' => array(
                        'image' => $request->image,
                        'weight' => $request->weight,
                    )
                ]);
        
                $output = "";
                $total = 0;
    
                $header = "";
                
                $carts = \Cart::session(Auth::user()->id)->getContent();
                if(!empty($carts))
                {
                    foreach ($carts as $key => $item) {
                        $output .= '<div class="cart-body">
                            <ul class="cart-item-list">
                                <li class="cart-item">
                                    <div class="item-img">
                                        <a href="#"><img src="'.asset('product/'. $item->attributes->image).'"
                                                alt="Commodo Blown Lamp"></a>
            
                                        <button class="close-btn"><a href="#" data-id="'.base64_encode($item->id).'"
                                                id="buton_delete_troli"><i class="fal fa-times"></i></a></button>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="#">'.$item->name.'</a></h3>
                                        <div class="item-price">'."Rp " . number_format($item->price, 0, ",", ".").'
                                        </div>
                                        <div class="pro-qty item-quantity">
                                            <input type="number" class="quantity-input" value="'.$item->quantity.'" name="quantity"
                                                min="1">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    '; }
        
                    $output .= '
                    <div class="cart-footer">
                        <h3 class="cart-subtotal">
                            <span class="subtotal-title">Subtotal:</span>
                            <span class="subtotal-amount">'."Rp. " . number_format(\Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".").'</span>
                        </h3>
                        <div class="group-btn">
                            <a href="'.url('cart').'" class="axil-btn btn-bg-primary viewcart-btn">Lihat Keranjang</a>
                            <a href="'.url('checkout').'" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                        </div>
                    </div>';
                    
                    $header = \Cart::session(Auth::user()->id)->getTotalQuantity();
                    return response()->json(['body' => $output, 'total' => $header], 201);
                } 
            } else {
                return response()->json(["status" => 3, "message" => "Jumlah melebihi stok yang ada, sisa stok ($product->quantity)"], 201);
            }
          
        } else {
            return response()->json(['status' => 2], 201);
        }
       
    }

    public function buyView($id)
    {
        if(Auth::check())
        {
            $product = Product::whereId(base64_decode($id))->first();

            $quan = 1;
            if($quan <= $product->quantity)
            {
                $cart = \Cart::session(Auth::user()->id)->add([
                    'id' => base64_decode($id),
                    'name' => $product->name,
                    'price' => $product->priceDisc,
                    'quantity' => 1,
                    'attributes' => array(
                        'image' => $product->image,
                        'weight' => $product->weight,
                    )
                ]);
        
                $output = "";
                $total = 0;
    
                $header = "";
                
                $carts = \Cart::session(Auth::user()->id)->getContent();
                if(!empty($carts))
                {
                    foreach ($carts as $key => $item) {
                        $output .= '<div class="cart-body">
                            <ul class="cart-item-list">
                                <li class="cart-item">
                                    <div class="item-img">
                                        <a href="#"><img src="'.asset('product/'. $item->attributes->image).'"
                                                alt="Commodo Blown Lamp"></a>
            
                                        <button class="close-btn"><a href="#" data-id="'.base64_encode($item->id).'"
                                                id="buton_delete_troli"><i class="fal fa-times"></i></a></button>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="#">'.$item->name.'</a></h3>
                                        <div class="item-price">'."Rp " . number_format($item->price, 0, ",", ".").'
                                        </div>
                                        <div class="pro-qty item-quantity">
                                            <input type="number" class="quantity-input" value="'.$item->quantity.'" name="quantity"
                                                min="1">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    '; }
        
                    $output .= '
                    <div class="cart-footer">
                        <h3 class="cart-subtotal">
                            <span class="subtotal-title">Subtotal:</span>
                            <span class="subtotal-amount">'."Rp. " . number_format(\Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".").'</span>
                        </h3>
                        <div class="group-btn">
                            <a href="'.url('cart').'" class="axil-btn btn-bg-primary viewcart-btn">Lihat Keranjang</a>
                            <a href="'.url('checkout').'" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                        </div>
                    </div>';
                    
                    $header = \Cart::session(Auth::user()->id)->getTotalQuantity();
                    return response()->json(['body' => $output, 'total' => $header], 201);
                } 
            } else {
                return response()->json(["status" => 3, "message" => "Jumlah melebihi stok yang ada, sisa stok ($product->quantity)"], 201);
            }
          
        } else {
            return response()->json(['status' => 2], 201);
        }
       
    }

    public function buyButton(Request $request)
    {
        if(Auth::check())
        {
            $product = Product::whereId($request->id)->first();

            if($request->quantity <= $product->quantity)
            {
                $cart = \Cart::session(Auth::user()->id)->add([
                    'id' => $request->id,
                    'name' => $request->name,
                    'price' => $request->priceDisc,
                    'quantity' => $request->quantity,
                    'attributes' => array(
                        'image' => $request->image,
                        'weight' => $request->weight,
                    )
                ]);
        
                $output = "";
                $total = 0;
    
                $header = "";
                
                $carts = \Cart::session(Auth::user()->id)->getContent();
                if(!empty($carts))
                {
                    foreach ($carts as $key => $item) {
                        $output .= '<div class="cart-body">
                            <ul class="cart-item-list">
                                <li class="cart-item">
                                    <div class="item-img">
                                        <a href="#"><img src="'.asset('product/'. $item->attributes->image).'"
                                                alt="Commodo Blown Lamp"></a>
            
                                        <button class="close-btn"><a href="#" data-id="'.base64_encode($item->id).'"
                                                id="buton_delete_troli"><i class="fal fa-times"></i></a></button>
                                    </div>
                                    <div class="item-content">
                                        <h3 class="item-title"><a href="#">'.$item->name.'</a></h3>
                                        <div class="item-price">'."Rp " . number_format($item->price, 0, ",", ".").'
                                        </div>
                                        <div class="pro-qty item-quantity">
                                            <input type="number" class="quantity-input" value="'.$item->quantity.'" name="quantity"
                                                min="1">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    '; }
        
                    $output .= '
                    <div class="cart-footer">
                        <h3 class="cart-subtotal">
                            <span class="subtotal-title">Subtotal:</span>
                            <span class="subtotal-amount">'."Rp. " . number_format(\Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".").'</span>
                        </h3>
                        <div class="group-btn">
                            <a href="'.url('cart').'" class="axil-btn btn-bg-primary viewcart-btn">Lihat Keranjang</a>
                            <a href="'.url('checkout').'" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                        </div>
                    </div>';
                    
                    $header = \Cart::session(Auth::user()->id)->getTotalQuantity();
                    return response()->json(['body' => $output, 'total' => $header], 201);
                }
            } else {
                
                return response()->json(["status" => 3, "message" => "Jumlah melebihi stok yang ada, sisa stok ($product->quantity)"], 201);
            }
             
        } else {
            return response()->json(['status' => 2, 'message' => 'Authentication'], 201);
        }
       
    }

    public function remove($id, Request $request)
    {
        if(Auth::check())
        {
            \Cart::session(Auth::user()->id)->remove(base64_decode($id));      
            return response()->json(['status' => 1], 201);
        } else {
            return response()->json(['status' => 2], 201);
        }
    }

    public function removeTroli($id, Request $request)
    {
            \Cart::session(Auth::user()->id)->remove(base64_decode($id));
            $output = "";
            $total = 0;

            $header = "";
            
            $carts = \Cart::session(Auth::user()->id)->getContent();
            if(!empty($carts))
            {
                foreach ($carts as $key => $item) {
                    $output .= '<div class="cart-body">
                        <ul class="cart-item-list">
                            <li class="cart-item">
                                <div class="item-img">
                                    <a href="#"><img src="'.asset('product/'. $item->attributes->image).'"
                                            alt="Commodo Blown Lamp"></a>
        
                                    <button class="close-btn"><a href="#" data-id="'.base64_encode($item->id).'"
                                            id="buton_delete_troli"><i class="fal fa-times"></i></a></button>
                                </div>
                                <div class="item-content">
                                    <div class="product-rating">
                                    
                                    </div>
                                    <h3 class="item-title"><a href="#">'.$item->name.'</a></h3>
                                    <div class="item-price">'."Rp " . number_format($item->price, 0, ",", ".").'
                                    </div>
                                    <div class="pro-qty item-quantity">
                                        <input type="number" class="quantity-input" value="'.$item->quantity.'" name="quantity"
                                            min="1">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                '; }
    
                $output .= '
                <div class="cart-footer">
                    <h3 class="cart-subtotal">
                        <span class="subtotal-title">Subtotal:</span>
                        <span class="subtotal-amount">'."Rp. " . number_format(\Cart::session(Auth::user()->id)->getTotal(), 0, ",", ".").'</span>
                    </h3>
                    <div class="group-btn">
                        <a href="'.url('cart').'" class="axil-btn btn-bg-primary viewcart-btn">Lihat Keranjang</a>
                        <a href="'.url('checkout').'" class="axil-btn btn-bg-secondary checkout-btn">Checkout</a>
                    </div>
                </div>';
                
                $header = \Cart::session(Auth::user()->id)->getTotalQuantity();
                return response()->json(['body' => $output, 'total' => $header], 201);
            } else {
                return response()->json(['status' => 2], 201);
            }    
    }

    public function update(Request $request)
    {
        \Cart::session(Auth::user()->id)->update(
            base64_decode($request->id),
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        
        return response()->json(['status' => 1], 201);
    }

    public function clearAll(Request $request)
    {
        \Cart::session(Auth::user()->id)->clear();
        return redirect('/cart');
    }
    
   
}
