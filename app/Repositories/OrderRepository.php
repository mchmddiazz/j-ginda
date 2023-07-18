<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Order();
    }

}