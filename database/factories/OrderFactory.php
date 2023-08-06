<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatusEnum;
use App\Models\User;
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
            'order_number' => $this->faker->randomNumber(8),
            'user_id' => User::all()->random()->id,
            'status' => $this->faker->randomElement(OrderStatus::values()),
            'grand_total' => $this->faker->numberBetween(25000, 200000),
            'item_count' => $this->faker->numberBetween(1, 10),
            'payment_status' => $this->faker->randomElement(PaymentStatusEnum::values()),
        ];
    }
}
