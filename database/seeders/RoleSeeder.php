<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public const DATA_ROLES = [
      "administrator","gudang", "user",
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA_ROLES as $key => $role){
            Role::create([
                "name" => $role
            ]);
        }
    }
}
