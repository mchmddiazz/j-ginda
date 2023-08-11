<?php

namespace App\Services\Admin;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Enums\TransactionTypeEnum;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;
    protected OrderItemRepository $orderItemRepository;
    protected TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
        $this->orderItemRepository = new OrderItemRepository();
        $this->transactionRepository = new TransactionRepository();
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
            "orders" => $this->repository->orderBy(["created_at" => "created_at"], "created_at", "DESC")->getAllDataPaginated(),
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

            if ($status === OrderStatus::SENDING()) {
                $this->getServiceEntity()->fill([
                    "status" => $status,
                    "tracking_number" => $requestedData["tracking_number"]
                ])->save();
            } elseif($status === OrderStatus::COMPLETED()){
                $this->getServiceEntity()->fill([
                    "status" => $status,
                ])->save();
            } else {
                $order = $this->getServiceEntity();
                if($status === "processing"){
                    $latestTransaction = $this->transactionRepository->latestTransaction();

                    $this->transactionRepository->addNewData([
                        "user_id" => Auth::id(),
                        "description" => "Penjualan Abon",
                        "amount" => $order->grand_total,
                        "type" => "debit",
                        "order_id" => $order->id,
                    ]);

                    $order->fill([
                        "status" => $status,
                        "payment_status" => PaymentStatusEnum::PAID()
                    ])->save();
                }

                if ($status === OrderStatus::DECLINE()) {
                    $order->fill([
                        "status" => $status,
                        "payment_status" => PaymentStatusEnum::REJECT()
                    ])->save();
                    $orderItems = $this->orderItemRepository->getAllData(["order_id" => $order->id]);

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