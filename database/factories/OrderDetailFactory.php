<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = Str::uuid();
        return [
            //
            "order_id" => $id,
            "book_id" => $this->faker->numberBetween(1, 100),
            "quantity" => $this->faker->numberBetween(10, 50),
            "book_price" => $this->faker->numberBetween(30, 100) * 1000,
            "created_at" =>  $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
