<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    /**
     * @param array $requestedData
     * @return true[]
     */
    public function registration(array $requestedData):array
    {
        try {
            $requestedData["password"] = Hash::make($requestedData["password"]);
            $user = $this->repository->addNewData($requestedData);
            event(new Registered($user));
            $user->assignRole("user");
            Auth::login($user);
            $response = ["success" => true];
        }catch (Exception $e){
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}