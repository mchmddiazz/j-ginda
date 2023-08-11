<?php

namespace App\Services\Admin;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            if(request()->hasFile("image")){
                $file = request()->file("image");
                $requestedData["image"] = Str::random(10) . $file->getClientOriginalName();
                Storage::putFileAs("public/products", $file, $requestedData["image"]);
            }

            if(request()->hasFile("image2")){
                $file2 = request()->file("image2");
                $requestedData["image2"] = Str::random(10) . $file2->getClientOriginalName();
                Storage::putFileAs("public/products", $file2, $requestedData["image2"]);
            }

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

            if(request()->hasFile("image")){
                $file = request()->file("image");
                $requestedData["image"] = Str::random(10) . $file->getClientOriginalName();
                Storage::putFileAs("public/products", $file, $requestedData["image"]);
            }

            $product->fill($requestedData)->save();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }


    /**
     * @param int $id
     * @return true[]
     */
    public function deleteById(int $id):array
    {
        try {
            $this->checkData($id);
            $product = $this->getServiceEntity();
            $product->delete();

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        
        return $response;
    }


    /**
     * @return array
     */
    public function getLowQuantityProduct():array
    {
        return [
            "products" => $this->repository->whereColumn("quantity", "<=", "quantity_threshold")->getAllDataPaginated(),
            "title" => "Low Quantity Product",
            "cardTitle" => "Low Quantity Product"
        ];
    }
}