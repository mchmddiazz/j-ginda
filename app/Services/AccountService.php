<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class AccountService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;
    protected OrderRepository $orderRepository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->orderRepository = new OrderRepository();
    }


    /**
     * @return array
     */
    public function getEditData():array
    {
        return [
            "orders" => $this->orderRepository->getAllDataPaginated(["user_id" => Auth::id()]),
            "user" => Auth::user()
        ];
    }

    /**
     * @param array $requestedData
     * @return array
     */
    public function updateData(array $requestedData):array
    {
        $user = Auth::user();
        $user->password = $requestedData["new_password"];
        $user->save();

        return [
            "success" => true
        ];
    }
}