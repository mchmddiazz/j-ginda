<?php

namespace App\Services\Admin;

use App\Enums\OrderStatus;
use App\Enums\TransactionTypeEnum;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;
    protected OrderItemRepository $orderItemRepository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
        $this->orderItemRepository = new OrderItemRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated(): array
    {
        if (request()->query("status") && request()->query("status") !== "all") {
            $this->repository->where("status", request()->query("status"));
        }
        return [
            "title" => "Order",
            "cardTitle" => "Order",
            "orders" => $this->repository->getAllDataPaginated(),
        ];
    }


    /**
     * @param int $id
     * @return array
     */
    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);

            $response = [
                "success" => true,
                "order" => $this->getServiceEntity()
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param int $id
     * @param string $status
     * @return array
     */
    public function updateStatusPayment(int $id, string $status, array $requestedData): array
    {
        try {
            $this->checkData($id);
            DB::beginTransaction();

            if ($status === OrderStatus::COMPLETED()) {
                $this->getServiceEntity()->fill([
                    "status" => $status,
                    "tracking_number" => $requestedData["tracking_number"]
                ])->save();

            } else {
                $this->getServiceEntity()->fill([
                    "status" => $status
                ])->save();


                if ($status === OrderStatus::DECLINE()) {
                    $orderItems = $this->orderItemRepository->getAllData(["order_id" => $this->getServiceEntity()->id]);

                    foreach ($orderItems as $key => $orderItem) {
                        $orderItem->product->quantity += $orderItem->quantity;
                        $orderItem->product->save();

                        $this->orderItemRepository->addNewData([
                            "code" => strtoupper(uniqid("DECLINE-")),
                            "order_id" => $this->getServiceEntity()->id,
                            "product_id" => $orderItem->product->id,
                            "quantity" => $orderItem->quantity,
                            "price" => $orderItem->price,
                            "type" => TransactionTypeEnum::DECLINE(),
                        ]);
                    }
                }

            }

            DB::commit();
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}