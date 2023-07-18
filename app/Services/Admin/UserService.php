<?php

namespace App\Services\Admin;

use App\Repositories\UserRepository;

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

}