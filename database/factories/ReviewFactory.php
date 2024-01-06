<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
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
            "user_id" => $this->faker->numberBetween(1, 30),
            "book_id" => $this->faker->numberBetween(1, 100),
            "comment" => $this->faker->paragraph(3),
            "ratting" => $this->faker->numberBetween(0, 5),
        ];
    }
}
