<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        foreach (PermissionEnum::cases() as $key => $permission){
            Permission::create([
                "name" => $permission->value,
                "description" => $permission->description(),
                "feature" => $permission->featureGroup(),
            ]);
        }
    }
}
