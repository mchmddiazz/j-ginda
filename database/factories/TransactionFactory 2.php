<?php

namespace Database\Factories;

use App\Enums\FinancialTransactionTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "description" => $this->faker->randomElement(["penjualan", "bahan baku", "gaji", "listrik"]),
            "type" => $this->faker->randomElement(FinancialTransactionTypeEnum::values()),
            "amount" => $this->faker->numberBetween(100,1000),
        ];
    }
}
