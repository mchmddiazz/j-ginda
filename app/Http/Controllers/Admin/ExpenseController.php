<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Expenses\StoreExpenseRequest;
use App\Services\Admin\ExpenseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{

    /**
     * @param ExpenseService $service
     * @return \Illuminate\Http\Response
     */
    public function create(ExpenseService $service):Response
    {
        $response = $service->getCreateData();

        viewShare($response);
        return response()->view('admin.expenses.create');
    }


    /**
     * @param ExpenseService $service
     * @param StoreExpenseRequest $request
     * @return RedirectResponse
     */
    public function store(ExpenseService $service, StoreExpenseRequest $request):RedirectResponse
    {
        $service->addNewData($request->validated());

        return redirect()->route("admin.expenses.create")->with("success", ucfirst("Tambah data pengeluaran berhasil !"));
    }
}
