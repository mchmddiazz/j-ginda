<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $orders = (new OrderRepository())->getAllData(["user_id" => Auth::id()]);
        viewShare(["orders" => $orders]);
        return response()->view('landing.orders.index');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order): Response
    {
        viewShare(["order" => $order]);
        return response()->view('landing.orders.show');
    }

    public function generateInvoice(int $id)
    {
        $order = (new OrderRepository())->getDataById($id);
        $customPaper = array(0, 0, 650, 1400);
        $pdf = Pdf::loadView('admin.invoices.index', [
            'order' => $order
        ])->setPaper($customPaper, 'portrait');

        return $pdf->stream();
    }


    public function update(int $id)
    {
        try {
            $order = (new OrderRepository())->getDataById($id);

            if (!$order) {
                throw new EmptyDataException();
            }

            $file = request()->file("image");
            $requestedData["image"] = Str::random(10) . $file->getClientOriginalName();
            Storage::putFileAs("public/payments", $file, $requestedData["image"]);

            $order->fill($requestedData)->save();
            $response = [
                "success" => true
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("orders.index")->with("success", ucfirst("Tambah payment berhasil !"));
    }
}
