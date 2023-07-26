<?php

namespace Database\Seeders;

use App\Models\RequestProduction;
use Illuminate\Database\Seeder;

class RequestProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestProduction::factory()->count(30)->create();
    }
}
