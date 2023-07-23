<?php

namespace App\Services\Admin;

use App\Repositories\TransactionRepository;

class ExpenseService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new TransactionRepository();
    }

    public function getCreateData(): array
    {
        return [
            "title" => "Pengeluaran",
            "cardTitle" => "Pengeluaran",
        ];
    }

}