<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
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
    function index(Request $request)
    {
        if(request()->ajax()) {
            $data = DB::table('role_users')
            ->join('users', 'role_users.user_id', '=', 'users.id')
            ->join('roles', 'role_users.role_id', '=', 'roles.id')
            ->select(
                'users.*',
                'users.id as id_user',
                'roles.name as role'
                )
            ->where('users.is_active', 1)
            ->get(); 
            return DataTables()->of($data)
                ->addColumn('action', function($data){
                    return '<a href="#" class="btn btn-info" data-id="'.$data->id_user.'" data-bs-toggle="modal" data-bs-target="#modelId" id="buton_edit"><i class="fa-solid fa-edit me-2"></i> Edit</a> '.
                    '<a href="#" class="btn btn-danger" data-id="'.$data->id_user.'" id="buton_hapus"><i class="fa-solid fa-trash me-2"></i> Hapus</a>';
                })
                ->addColumn('created_at', function($data){
                    return Carbon::parse($data->created_at)->isoFormat('dddd, D MMMM Y');
                 })
                 ->addColumn('last_login', function($data){
                    return Carbon::parse($data->last_login)->isoFormat('dddd, D MMMM Y');
                 })
                 ->addColumn('role', function($data){
                    if ($data->role == 'user') {
                        return '<span class="badge badge-info">User</span>';
                    } elseif($data->role == 'admin') {
                        return ' <span class="badge badge-success">Admin</span>';
                    }
                })
                 
                ->rawColumns(['action', 'created_at', 'last_login', 'role'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.users.index');
    }

    function store(Request $request)
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

    function edit($id)
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
