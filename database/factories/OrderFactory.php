<?php

namespace Database\Factories;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(8),
            'total_price' => $this->faker->numberBetween(25000, 200000),
            'payment_status' => PaymentStatusEnum::PAID(),
        ];
    }
}
