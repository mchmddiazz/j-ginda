<?php

namespace App\Services\Admin;

use App\Repositories\ProductRepository;
use Exception;
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
    public function getAllDataPaginated(): array
    {
        return [
            "products" => $this->repository->getAllDataPaginated(),
            "title" => "Produk",
            "cardTitle" => "Produk"
        ];
    }

    /**
     * @param array $requestedData
     * @return true[]
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);

            $response = [
                "success" => true
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }


    /**
     * @param int $id
     * @return array
     */
    public function getEditData(int $id):array
    {
        try {
            $this->checkData($id);

            $response = [
                "success" => true,
                "title"=> "Edit Produk",
                "cardTitle" => "Produk",
                "product"=> $this->getServiceEntity()
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }


    /**
     * @param int $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData):array
    {
        try {
            $this->checkData($id);
            $product = $this->getServiceEntity();
            $product->fill($requestedData)->save();

            $response = [
                "success" => true,
                "title"=> "Edit Produk",
                "cardTitle" => "Produk",
                "product"=> $product
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }
}