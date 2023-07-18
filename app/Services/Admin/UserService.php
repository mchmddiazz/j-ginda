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
    public function getAllDataPaginated(): array
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
    public function getCreateData(): array
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
    public function addNewData(array $requestedData): array
    {
        try {
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
    public function getEditData(int $id): array
    {
        try {
            $this->checkData($id);

            $response = [
                "success" => true,
                "user" => $this->getServiceEntity()
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
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);

            if ($requestedData["password"] === null) {
                unset($requestedData["password"]);
            }
            $this->getServiceEntity()->fill($requestedData)->save();

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
     * @return array|true[]
     */
    public function deleteDataById(int $id):array
    {
        try {
            $this->checkData($id);

            $this->getServiceEntity()->delete();
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}