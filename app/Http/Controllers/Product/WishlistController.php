<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Maize\Markable\Models\Favorite;
class WishlistController extends Controller
{
    function wishlist()
    {
        $data['product'] = Product::whereHasFavorite(
            auth()->user()
        )->get();

        return view('landingPage.wishlist', $data);
    }

    function favoriteAdd($id)
    {
        $product = Product::find($id);
        $user = auth()->user();
        Favorit::add($product, $user);

        return response()->json(['status' => 1], 201);
        // Product Is Remove
    }

    function favoriteRemove($id)
    {
        $product = Product::find($id);
        $user = auth()->user();
        Favorite::remove($product, $user);
        
        return response()->json(['status' => 1], 201);
        // Product Is Remove
    }


}
