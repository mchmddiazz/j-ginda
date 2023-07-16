<?php

namespace App\Repositories\Product;

interface ProductRepository
{
    public function findAll();

    public function find($id);
}