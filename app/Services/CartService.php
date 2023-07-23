<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class CartService extends BaseService
{
    public static function getCartFromSession()
    {
        return \Cart::session(Auth::user()->id)->getContent();
    }
}