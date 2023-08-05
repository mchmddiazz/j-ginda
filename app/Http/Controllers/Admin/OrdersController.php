<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\UpdateStatusPaymentRequest;
use App\Models\OrderItem;
use App\Repositories\OrderRepository;
use App\Services\Admin\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class OrdersController extends Controller
{

    /**
     * @param OrderService $service
     * @return Response
     */
    public function index(OrderService $service): Response
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
    public function show(OrderService $service, int $id): Response|RedirectResponse
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
     * @param UpdateStatusPaymentRequest $request
     * @return RedirectResponse
     */
    public function updatePaymentStatus(OrderService $service, int $id, string $status, UpdateStatusPaymentRequest $request): RedirectResponse
    {
        $response = $service->updateStatusPayment($id, $status, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.orders.index")->with("success", ucfirst("Update status pembayaran berhasil !"));
    }


    /**
     * @param int $id
     * @return Response|null
     */
    public function generateInvoice(int $id)
    {
        $order = (new OrderRepository())->getDataById($id);
        $customPaper = array(0,0,650,1400);
        $pdf = Pdf::loadView('admin.invoices.index', [
            'order' => $order
        ])->setPaper($customPaper, 'portrait');

        return $pdf->stream();
    }
}
