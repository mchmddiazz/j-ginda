<?php

namespace App\Repositories;

use App\Models\AboutUs;
use App\Models\Order;

class AboutUsRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new AboutUs();
    }

}