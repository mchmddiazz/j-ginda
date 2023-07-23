<?php

namespace App\Services\Admin;

use App\Repositories\TransactionRepository;

class FinanceTransactionService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
    }


    /**
     * @return array
     */
    public function getAllDataPaginated():array
    {
        if (request()->query("type") && request()->query("type") !== "all") {
            $this->repository->where("type", request()->query("type"));
        }
        return [
            "title" => "Transaksi",
            "cardTitle" => "Transaksi",
            "transactions" => $this->repository->orderBy(columns: "created_at", direction: "desc")->getAllDataPaginated(),
        ];
    }

}