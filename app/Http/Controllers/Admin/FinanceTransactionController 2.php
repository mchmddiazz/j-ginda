<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\FinanceTransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FinanceTransactionController extends Controller
{

    /**
     * @param FinanceTransactionService $service
     * @return Response
     */
    public function index(FinanceTransactionService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);
        return response()->view('admin.transactions.index');
    }
}
