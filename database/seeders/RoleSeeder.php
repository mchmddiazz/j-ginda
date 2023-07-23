<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public const DATA_ROLES = [
        "superadmin","administrator", "gudang", "user",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA_ROLES as $key => $role) {
            Role::create([
                "name" => $role,
                "guard_name" => "web"
            ]);
        }

        $role = Role::find(2);
        foreach (PermissionEnum::values() as $key => $permission){
            $role->givePermissionTo($permission);
        }
    }
}
