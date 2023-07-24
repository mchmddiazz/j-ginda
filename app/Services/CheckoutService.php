<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\ProvinceSecond;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Iqbalatma\LaravelServiceRepo\BaseService;

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
            if ($requestedData["alamat2"] == "no" || $requestedData["alamat2"] == null) {
                $address = $requestedData["address"];
                $address2 = $requestedData["address2"];
                $province_id = $requestedData["province_id"];
                $regency_id = $requestedData["regency_id"];
                $post_code = $requestedData["post_code"];
                $phone_number = $requestedData["phone_number"];
                $email = $requestedData["email"];
            } else if ($requestedData["alamat2"] == "yes") {
                $address = $requestedData["address1"];
                $address2 = $requestedData["address22"];
                $province_id = $requestedData["province_id2"];
                $regency_id = $requestedData["regency_id2"];
                $post_code = $requestedData["post_code2"];
                $phone_number = $requestedData["phone_number2"];
                $email = $requestedData["email2"];
            }


            $order = $this->repository->addNewData([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'user_id' => Auth::id(),
                'status' => 'pending',
                'grand_total' => $requestedData["totalpayment"],
                'item_count' => Cart::session(Auth::user()->id)->getTotalQuantity(),
                'payment_status' => PaymentStatusEnum::WAITING(),
                'first_name' => $requestedData["first_name"],
                'last_name' => $requestedData["last_name"],
                'email' => $email,
                'company' => $requestedData["company"],
                'address' => $address,
                'address2' => $address2,
                'province_id' => $province_id,
                'regency_id' => $regency_id,
                'post_code' => $post_code,
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
            $response = ["success" => true];
        } catch (Exception $e) {
            DB::rollBack();
            $response = getDefaultErrorResponse($e);
        }


        return $response;
    }
}