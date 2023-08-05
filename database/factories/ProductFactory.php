<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "Abon " . Str::random(3),
            "description" => "Description " . $this->faker->text,
            "price" => $this->faker->numberBetween(10000,100000),
            "priceDisc" => $this->faker->numberBetween(10000,100000),
            "quantity" => $this->faker->numberBetween(1,1000),
            "quantity_threshold" => $this->faker->numberBetween(1,1000),
            "weight" => $this->faker->numberBetween(1,1000),
        ];
    }
}
