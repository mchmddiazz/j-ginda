<?php

namespace Database\Seeders;

use App\Enums\TableEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public const DATA_USERS = [
        [
            "name" => "admin",
            "email" => "admin@mail.com",
            "password" => '$2y$10$ib2VYv7bxGXFKa44/yu1DeC5y8uvn//he6kNZKaceSpHMAZdwxgsq',
            "address" => "Address",
            "postal_code" => "79452",
            "phone" => "0895351172040",
        ],
        [
            "name" => "gudang",
            "email" => "gudang@mail.com",
            "password" => '$2y$10$ib2VYv7bxGXFKa44/yu1DeC5y8uvn//he6kNZKaceSpHMAZdwxgsq',
            "address" => "Address",
            "postal_code" => "79452",
            "phone" => "0895351172040",
        ],
        [
            "name" => "user",
            "email" => "user@mail.com",
            "password" => '$2y$10$ib2VYv7bxGXFKa44/yu1DeC5y8uvn//he6kNZKaceSpHMAZdwxgsq',
            "address" => "Address",
            "postal_code" => "79452",
            "phone" => "0895351172040",
        ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::DATA_USERS as $key => $user) {
            User::create($user);
        }

        User::find(1)->assignRole("administrator");
        User::find(2)->assignRole("gudang");
        User::find(3)->assignRole("user");
    }
}