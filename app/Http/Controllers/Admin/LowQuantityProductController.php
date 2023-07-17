<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LowQuantityProductController extends Controller
{
    /**
     * @param ProductService $service
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProductService $service):Response
    {
        $response = $service->getLowQuantityProduct();

        viewShare($response);
        return response()->view("admin.product.low-quantity");
    }
}
