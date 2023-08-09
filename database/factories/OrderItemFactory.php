<?php

namespace Database\Factories;

use App\Enums\TransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "code" => Str::random(8),
            "order_id" => $this->faker->numberBetween(1,100),
            "product_id" => $this->faker->numberBetween(1,100),
            "quantity" => $this->faker->numberBetween(1,20),
            "price" => $this->faker->numberBetween(100,10000),
            "type" => $this->faker->randomElement(TransactionTypeEnum::values())
        ];
    }
}
