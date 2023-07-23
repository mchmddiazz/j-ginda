<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Iqbalatma\LaravelServiceRepo\BaseService;

class HomeService extends BaseService
{

    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }

    /**
     * @return array
     */
    public function getIndexData():array
    {
        $products = $this->repository->getAllDataPaginated();
        return [
            "slide" => [],
            "products" => $products

        ];
    }
}