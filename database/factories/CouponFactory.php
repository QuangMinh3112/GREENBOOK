<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "name" => $this->faker->name(),
            "value" => $this->faker->numberBetween(10, 30),
            "type" => $this->faker->randomElement(['percent', 'number', 'free_ship']),
            "quantity" => $this->faker->numberBetween(10, 100),
            "start_date" => $this->faker->dateTimeBetween('-3 month', 'now'),
            "end_date" => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            "point_required" => $this->faker->numberBetween(100, 500),
            "price_required" => $this->faker->numberBetween(50000, 500000),
            "code" => strtoupper(Str::random(10)),
            "status" => $this->faker->randomElement(['public', 'private']),
        ];
    }
}
