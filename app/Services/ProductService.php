<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;

class ProductService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository();
    }


    /**
     * @param int $id
     * @return array
     */
    public function getDataById(int $id):array
    {
        try {
            $this->checkData($id);

            $response= [
                "title" => "Detail Produk",
                "success" => true,
                "product" => $this->getServiceEntity(),
                "productList" => $this->repository->getAllData()
            ];
        }catch (Exception $e){
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }

}