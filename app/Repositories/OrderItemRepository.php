<?php

namespace App\Repositories;

use App\Models\OrderItem;
use App\Models\RequestProduction;

class OrderItemRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new OrderItem();
    }
}