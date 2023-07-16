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
     * @return LengthAwarePaginator
     */
    public function getAllDataPaginated():LengthAwarePaginator
    {
        return $this->repository->getAllDataPaginated();
    }
}