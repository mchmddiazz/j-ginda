<?php

namespace App\Services\Admin;

use App\Repositories\AboutUsRepository;

class AboutUsService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new AboutUsRepository();
    }


    /**
     * @return array
     */
    public function getAllData():array
    {
        return [
            "title" => "About Us",
            "cardTitle" => "About Us",
            "aboutUs" => $this->repository->getAllDataPaginated()
        ];
    }

    /**
     * @return string[]
     */
    public function getCreateData():array
    {
        return [
            "title" => "About Us",
            "cardTitle" => "About Us",
        ];
    }

}