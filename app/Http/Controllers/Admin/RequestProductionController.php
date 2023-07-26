<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestProduction\StoreRequestProductionRequest;
use App\Http\Requests\Admin\RequestProduction\UpdateRequestProductionRequest;
use App\Services\Admin\RequestProductionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestProductionController extends Controller
{
    /**
     * @param RequestProductionService $service
     * @return Response
     */
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


    /**
     * @param RequestProductionService $service
     * @param UpdateRequestProductionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RequestProductionService $service, UpdateRequestProductionRequest $request)
    {
        $response = $service->productionDone($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.request.production.index")->with("success", ucfirst("Permintaan produksi selesai !"));
    }
}
