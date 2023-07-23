<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Role;
use App\Models\User;

class RoleRepository extends \Iqbalatma\LaravelServiceRepo\BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Role();
    }
}