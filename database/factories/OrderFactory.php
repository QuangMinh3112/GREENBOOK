<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = Str::uuid();
        $code = strtoupper(Str::random(10));
        $ship_fee = $this->faker->numberBetween(20, 60) * 1000;
        $total_product_amout = $this->faker->numberBetween(100, 500) * 1000;

        return [
            "id" => $id,
            "order_code" => $code,
            "name" => $this->faker->name(),
            "email" => $this->faker->email(),
            "phone_number" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
            "status" => $this->faker->randomElement(['pending', 'confirmed', 'shipping', 'shipped', 'completed', 'failed', 'cancel', 'refund']),
            "ship_fee" => $ship_fee,
            "total_product_amount" => $total_product_amout,
            "total" => $ship_fee + $total_product_amout,
            "service_id" => $this->faker->numberBetween(100, 500) * 1000,
            "province_id" => $this->faker->numberBetween(100, 500) * 1000,
            "district_id" => $this->faker->numberBetween(100, 500) * 1000,
            "ward_id" => $this->faker->numberBetween(100, 500) * 1000,
            "user_id" => $this->faker->randomElement([null, $this->faker->numberBetween(1, 100)]),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }
}
