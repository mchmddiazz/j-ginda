<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Product();
    }

}