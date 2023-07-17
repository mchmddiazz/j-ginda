<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestProduction\StoreRequestProductionRequest;
use App\Services\Admin\RequestProductionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestProductionController extends Controller
{
    public function index(RequestProductionService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);

        return response()->view("admin.request-production.index");
    }
    /**
     * @param RequestProductionService $service
     * @param StoreRequestProductionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RequestProductionService $service, StoreRequestProductionRequest $request)
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.products.low.quantity")->with("success", ucfirst("Tambah permintaan produksi berhasil !"));
    }
}
