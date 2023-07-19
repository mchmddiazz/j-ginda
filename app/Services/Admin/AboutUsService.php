<?php

namespace App\Services\Admin;

use App\Repositories\AboutUsRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function addNewData(array $requestedData):array
    {
        try {
            if(request()->hasFile("image")){
                $file = request()->file("image");
                $requestedData["image"] = Str::random(10) . $file->getClientOriginalName();
                Storage::putFileAs("public/about-us", $file, $requestedData["image"]);
            }
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