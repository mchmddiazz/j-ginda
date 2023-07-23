<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\UpdateRoleRequest;
use App\Services\Admin\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * @param RoleService $service
     * @return Response
     */
    public function index(RoleService $service): Response
    {
        $response = $service->getAllDataPaginated();
        viewShare($response);
        return response()->view("admin.roles.index");
    }


    /**
     * @param RoleService $service
     * @param int $id
     * @return Response|RedirectResponse
     */
    public function edit(RoleService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getEditData($id);
        if ($this->isError($response)) return $this->getErrorResponse();

        viewShare($response);
        return response()->view("admin.roles.edit");
    }


    /**
     * @param RoleService $service
     * @param UpdateRoleRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoleService $service, UpdateRoleRequest $request, int $id):RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.roles.index")->with("success", ucfirst("Update data role berhasil !"));
    }
}
