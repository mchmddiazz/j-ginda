<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * @return Response
     */
    public function __invoke():Response
    {
        viewShare([
            "permissions" => (new PermissionRepository())->getAllDataPaginated()
        ]);
        return response()->view("admin.permissions.index");
    }
}
