<?php

namespace Database\Factories;

use App\Enums\ProductionStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestProductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => User::all()->random()->id,
            "product_id" => Product::all()->random()->id,
            "request_quantity" => $this->faker->numberBetween(1,100),
            "actual_quantity" => $this->faker->numberBetween(1,100),
            "status" => $this->faker->randomElement(ProductionStatus::values())
        ];
    }
}
