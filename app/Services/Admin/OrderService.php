<?php

namespace App\Services\Admin;

use App\Repositories\OrderRepository;

class OrderService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated():array
    {
        if(request()->query("status") && request()->query("status")!== "all" ){
            $this->repository->where("status", request()->query("status"));
        }
        return [
            "title" => "Order",
            "cardTitle" => "Order",
            "orders" => $this->repository->getAllDataPaginated(),
        ];
    }
}