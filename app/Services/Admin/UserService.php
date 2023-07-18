<?php

namespace App\Services\Admin;

use App\Repositories\UserRepository;
use Exception;

class UserService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated():array
    {
        return [
            "title" => "Users",
            "cardTitle" => "Users",
            "users" => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * @return string[]
     */
    public function getCreateData():array
    {
        return [
            "title" => "Users",
            "cardTitle" => "Users"
        ];
    }


    /**
     * @param array $requestedData
     * @return true[]
     */
    public function addNewData(array $requestedData):array
    {
        try {
            $this->repository->addNewData($requestedData);
            $response = [
                "success" => true
            ];
        }catch (Exception $e){
            $response = getDefaultErrorResponse($e);
        }


        return $response;
    }

}