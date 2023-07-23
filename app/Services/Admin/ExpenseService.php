<?php

namespace App\Services\Admin;

use App\Repositories\TransactionRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class ExpenseService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
    }


    /**
     * @return string[]
     */
    public function getCreateData(): array
    {
        return [
            "title" => "Pengeluaran",
            "cardTitle" => "Pengeluaran",
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