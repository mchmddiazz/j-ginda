<?php

namespace App\Services\Admin;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class RoleService extends BaseService
{
    protected $repository;
    protected PermissionRepository $permissionRepository;

    public function __construct()
    {
        $this->repository = new RoleRepository();
        $this->permissionRepository = new PermissionRepository();
    }

    /**
     * @return array
     */
    public function getAllDataPaginated():array
    {
        return [
          "title" => "Roles",
          "cardTitle" => "Roles",
          "roles" => $this->repository->getAllDataPaginated(),
        ];
    }


    /**
     * @param int $id
     * @return array
     */
    public function getEditData(int $id):array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();

            $permissions = $this->permissionRepository->getAllData();
            $this->setActivePermission($permissions, $role);
            $permissions = $permissions->groupBy("feature");

            $response = [
                "success" => true,
                "role" => $role,
                "permissions" => $permissions
            ];
        }catch (Exception $e){
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param int $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData):array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();
            $role->syncPermissions($requestedData);

            $response = [
                "success" => true,
            ];
        }catch (Exception $e){
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }

    /**
     * @param object|null $permissions
     * @param object $role
     * @return void
     */
    private function setActivePermission(object|null &$permissions, object $role): void
    {
        $rolePermission =  array_flip($role->permissions->pluck("name")->toArray());
        $permissions = collect($permissions)->map(function ($item) use ($rolePermission) {
            $item["is_active"] = isset($rolePermission[$item["name"]]);

            return $item;
        });
    }
}