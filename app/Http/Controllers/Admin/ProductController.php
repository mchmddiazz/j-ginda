<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\OrderItem;
use App\Services\Admin\ProductService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    /**
     * @param ProductService $service
     * @return Response
     */
    public function index(ProductService $service):Response
    {
        $response = $service->getAllDataPaginated();

        viewShare($response);
        return response()->view("admin.product.index");
    }


    /**
     * @param ProductService $service
     * @param StoreProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductService $service, StoreProductRequest $request):RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        
        return redirect()->route("admin.products.index")->with("success", ucfirst("Tambah data produk berhasil !"));
    }


    /**
     * @param ProductService $service
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function edit(ProductService $service, int $id):Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("admin.product.edit");
    }


    /**
     * @param ProductService $service
     * @param UpdateProductRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductService $service, UpdateProductRequest $request, int $id):RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.products.index")->with("success", ucfirst("Edit data produk berhasil !"));
    }

    /**
     * @param ProductService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(ProductService $service, int $id):RedirectResponse
    {
        $response = $service->deleteById($id);
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.products.index")->with("success", ucfirst("Hapus data produk berhasil !"));
    }
}
