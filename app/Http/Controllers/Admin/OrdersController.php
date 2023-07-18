<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\UpdateStatusPaymentRequest;
use App\Services\Admin\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
class OrdersController extends Controller
{

    /**
     * @param OrderService $service
     * @return Response
     */
    public function index(OrderService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);
        return response()->view('admin.orders.index');
    }


    /**
     * @param OrderService $service
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function show(OrderService $service, int $id):Response|RedirectResponse
    {
        $response = $service->getDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        viewShare($response);
        return response()->view("admin.orders.show");
    }


    /**
     * @param OrderService $service
     * @param int $id
     * @param string $status
     * @return RedirectResponse
     */
    public function updatePaymentStatus(OrderService $service, int $id, string $status, UpdateStatusPaymentRequest $request):RedirectResponse
    {
        $response = $service->updateStatusPayment($id, $status, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.orders.index")->with("success", ucfirst("Update status pembayaran berhasil !"));
    }
}
