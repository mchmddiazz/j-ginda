<?php

namespace App\Services\Admin;

use App\Enums\ProductionStatus;
use App\Repositories\RequestProductionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;

class RequestProductionService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new RequestProductionRepository();
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


}