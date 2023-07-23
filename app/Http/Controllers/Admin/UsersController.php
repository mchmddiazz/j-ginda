<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Services\Admin\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{

    /**
     * @return Response
     */
    public function index(UserService $service):Response
    {
        $response = $service->getAllDataPaginated();
        viewShare($response);
        return response()->view("admin.users.index");
    }

    /**
     * @param UserService $service
     * @return Response
     */
    public function create(UserService $service):Response
    {
        $response = $service->getCreateData();

        viewShare($response);
        return response()->view("admin.users.create");
    }


    /**
     * @param UserService $service
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(UserService $service, StoreUserRequest $request):RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.users.index")->with("success", ucfirst("Tambah data user berhasil !"));

    }


    /**
     * @param UserService $service
     * @param int $id
     * @return Response
     */
    public function edit(UserService $service, int $id):Response|RedirectResponse
    {
        $response = $service->getEditData($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        viewShare($response);
        return response()->view("admin.users.edit");
    }


    /**
     * @param UserService $service
     * @param UpdateUserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserService $service, UpdateUserRequest $request,int $id):RedirectResponse
    {
        (array) $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.users.index")->with("success", ucfirst("Update data user berhasil !"));
    }


    /**
     * @param UserService $service
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(UserService $service, int $id):RedirectResponse
    {
        (array) $response = $service->deleteDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("admin.users.index")->with("success", ucfirst("Hapus data user berhasil !"));
    }
}
