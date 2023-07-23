<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ExpenseService;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function create(ExpenseService $service)
    {
        $response = $service->getCreateData();

        viewShare($response);
        return response()->view('admin.expenses.create');
    }

    public function store()
    {
        
    }
}
