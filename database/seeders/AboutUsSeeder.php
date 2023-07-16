<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AboutUs::create([
            "name" => "Abon Alfitri",
            "description" => "produsen abon terbaik se-Indonesia",
            "image" => "20230622132643.png",
            "address" => "Bandung",
            "email" => "abonalfitri@gmail.com",
            "phone_number" => "089662390211",
        ]);
    }
}
