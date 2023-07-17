<?php

namespace App\Repositories;

use App\Models\RequestProduction;

class RequestProductionRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new RequestProduction();
    }
}