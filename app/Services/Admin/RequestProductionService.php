<?php

namespace App\Services\Admin;

use App\Enums\ProductionStatus;
use App\Enums\TransactionTypeEnum;
use App\Repositories\OrderItemRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RequestProductionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class RequestProductionService extends BaseService
{
    protected $repository;
    protected OrderItemRepository $orderItemRepository;
    protected ProductRepository $productRepository;

    public function __construct()
    {
        $this->repository = new RequestProductionRepository();
        $this->orderItemRepository = new OrderItemRepository();
        $this->productRepository = new ProductRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated(): array
    {
        return [
            "requestProductions" => $this->repository->getAllDataPaginated(),
            "title" => "Permintaan Produksi",
            "cardTitle" => "Permintaan Produksi",
        ];
    }


    /**
     * @param array $requestedData
     * @return true[]
     */
    public function addNewData(array $requestedData): array
    {
        try {
            DB::beginTransaction();
            foreach ($requestedData["product_ids"] as $key => $productId) {
                if ($requestedData["quantities"][$key]) {
                    $this->repository->addNewData([
                        "user_id" => Auth::id(),
                        "product_id" => $productId,
                        "status" => ProductionStatus::WAITING(),
                        "actual_quantity" => 0,
                        "request_quantity" => $requestedData["quantities"][$key]
                    ]);
                }
            }
            $response = ["success" => true];
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param array $requestedData
     * @return array
     */
    public function productionDone(array $requestedData): array
    {
        try {
            DB::beginTransaction();
            foreach ($requestedData["request_production_ids"] as $key => $requestProductionId) {
                if ($requestedData["actual_quantities"][$key]) {
                    $requestProduction = $this->repository->getDataById($requestProductionId);
                    if ($requestProduction) {
                        $requestProduction->fill([
                            "status" => ProductionStatus::DONE(),
                            "actual_quantity" => $requestedData["actual_quantities"][$key],
                        ])->save();

                        $this->orderItemRepository->addNewData([
                            "product_id" => $requestProduction->product_id,
                            "type" => TransactionTypeEnum::IN(),
                            "quantity" => $requestedData["actual_quantities"][$key],
                        ]);

                        $product = $this->productRepository->getDataById($requestProduction->product_id);
                        if($product){
                            $product->quantity += $requestedData["actual_quantities"][$key];
                            $product->save();
                        }
                    }
                }
            }
            $response = ["success" => true];
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}