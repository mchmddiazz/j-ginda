<?php

namespace App\Services\Admin;

use App\Repositories\ProductRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated():array
    {
        return [
            "products" => $this->repository->getAllDataPaginated(),
            "title" => "Produk"
        ];
    }
}