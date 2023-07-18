<?php

namespace App\Http\Controllers\Admin;

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
     * //todo: assign role to this user ``;
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

    function store2(Request $request)
    {
		date_default_timezone_set('Asia/Jakarta');
        if ($request->password == $request->confirm_password) 
        { 
            $users_id = $request->user_id;
            $details = [
                'name'          => $request->name,
                'email'         => $request->email,
                'password'      => Hash::make($request->password),
                'api_token'     => 0,
                'is_active'     => 1,
                'avatar'        => 'default.png',
                'alredy_login'  => 0,
                'last_login'    => null
            ];
            $users   =   User::updateOrCreate(['id' => $users_id], $details);  
    
            if ($request->role == 1) {    
                $users->roles()->attach(Role::where('name', 'admin')->first());
            } else {
                $users->roles()->attach(Role::where('name', 'user')->first());
            }
    
            return response()->json($users);
        } else {
            return response()->json(['status' => 2, 'error' => 'Password Tidak Sama'], 201);
        }
    }

    function edit2($id)
    {
        $where = array('users.id' => $id);

        $users  = DB::table('role_users')
        ->join('users', 'role_users.user_id', '=', 'users.id')
        ->join('roles', 'role_users.role_id', '=', 'roles.id')
        ->select(
            'users.*',
            'roles.id as roles_id',
            'users.id as id_user',
            'roles.name as role'
            )
        ->where($where)->first();
    
        return response()->json($users);
    }

    function destroy($id)
    {
        $users              = User::where('id', $id)->first();
        $users->is_active   = 0;
        $users->save();
    
        return response()->json($users);
    }
}
