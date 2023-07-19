<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutUs\StoreAboutUsRequest;
use App\Http\Requests\Admin\AboutUs\UpdateAboutUsRequest;
use App\Services\Admin\AboutUsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{
    /**
     * @param AboutUsService $service
     * @param Request $request
     * @return Response
     */
    public function index(AboutUsService $service): Response
    {
        $response = $service->getAllData();
        viewShare($response);
        return response()->view('admin.about-us.index');
    }


    /**
     * @param AboutUsService $service
     * @return Response
     */
    public function create(AboutUsService $service): Response
    {
        $response = $service->getCreateData();

        viewShare($response);
        return response()->view('admin.about-us.create');
    }


    /**
     * @param AboutUsService $service
     * @return RedirectResponse
     */
    public function store(AboutUsService $service, StoreAboutUsRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.about.us.index")->with("success", ucfirst("Tambah data about us berhasil !"));
    }


    /**
     * @param AboutUsService $service
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function edit(AboutUsService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) return $this->getErrorResponse();

        viewShare($response);
        return response()->view('admin.about-us.edit');
    }


    /**
     * @param AboutUsService $service
     * @param UpdateAboutUsRequest $request
     * @return RedirectResponse
     */
    public function update(AboutUsService $service, UpdateAboutUsRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.about.us.index")->with("success", ucfirst("Tambah data about us berhasil !"));
    }


    /**
     * @param AboutUsService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(AboutUsService $service, int $id):RedirectResponse
    {
        $response = $service->deleteDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.about.us.index")->with("success", ucfirst("Tambah data about us berhasil !"));

    }
}
