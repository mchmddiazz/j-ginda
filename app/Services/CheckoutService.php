<?php

namespace App\Services;

use App\Models\ProvinceSecond;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelServiceRepo\BaseService;

class CheckoutService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        $carts = CartService::getCartFromSession();
        return [
            "title" => "Checkout",
            "user" => Auth::user(),
            "provinces" => ProvinceSecond::pluck('name', 'province_id'),
            "carts" => $carts,
            "weight" => collect($carts)->sum("attributes.weight")
        ];
    }
}