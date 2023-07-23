<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Expenses\StoreExpenseRequest;
use App\Services\Admin\ExpenseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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
        $service->addNewData(array_merge($request->validated(), ["user_id" => Auth::id()]));

        return redirect()->route("admin.expenses.create")->with("success", ucfirst("Tambah data pengeluaran berhasil !"));
    }
}
