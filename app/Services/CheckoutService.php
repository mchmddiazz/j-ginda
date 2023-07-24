<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Models\ProvinceSecond;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Cart;

class CheckoutService extends BaseService
{
    protected $repository;
    protected ProductRepository $productRepository;
    protected OrderItemRepository $orderItemRepository;

    public function __construct()
    {
        $this->repository = new OrderRepository();
        $this->productRepository = new ProductRepository();
        $this->orderItemRepository = new OrderItemRepository();
    }

    /**
     * @return array
     */
    public function getCreateData(): array
    {
        $carts = CartService::getCartFromSession();
        return [
            "title" => "Checkout",
            "user" => Auth::user(),
            "provinces" => ProvinceSecond::pluck('name', 'province_id'),
            "carts" => $carts,
            "weight" => collect($carts)->sum("attributes.weight")
        ];
    }

    public function checkout(array $requestedData): array
    {
        try {
            DB::beginTransaction();
            $address = null;
            $city_id = null;
            $province_id = null;
            $postal_code = null;
            $phone_number = null;

            if(isset($requestedData["is_custom_address"]) && $requestedData["is_custom_address"]==true){
                $address = $requestedData["address"];
                $city_id = $requestedData["city_id"];
                $province_id = $requestedData["province_id"];
                $postal_code = $requestedData["postal_code"];
                $phone_number = $requestedData["phone_number"];
            }

            $order = $this->repository->addNewData([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => Auth::id(),
                'status' => OrderStatus::PENDING(),
                'grand_total' => $requestedData["totalpayment"],
                'item_count' => Cart::session(Auth::user()->id)->getTotalQuantity(),
                'payment_status' => PaymentStatusEnum::WAITING(),
                'address' => $address,
                'province_id' => $province_id,
                'city_id' => $city_id,
                'postal_code' => $postal_code,
                'phone_number' => $phone_number,
                'notes' => $requestedData["notes"],
                'expedisi' => $requestedData["expedisi"],
                'weight' => $requestedData["weight"],
                'ongkir' => $requestedData["ongkir"]
            ]);

            $items = \Cart::session(Auth::id())->getContent();

            foreach ($items as $item) {
                // A better way will be to bring the product id with the cart items
                // you can explore the package documentation to send product id with the cart
                if ($product = $this->productRepository->getSingleData(["name" => $item->name])) {
                    $this->orderItemRepository->addNewData([
                        "code" => strtoupper(uniqid("OUT-")),
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price' => $item->getPriceSum(),
                        "order_id" => $order->id
                    ]);


                    $product->quantity -= $item->quantity;
                    $product->save();
                }
            }
            \Cart::session(Auth::user()->id)->clear();

            DB::commit();
            $response = ["success" => true, "order_id" => $order->id];
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
        }


        return $response;
    }
}