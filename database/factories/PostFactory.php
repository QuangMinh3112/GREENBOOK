<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            'title' => $this->faker->name(),
            'content' => $this->faker->paragraph(10),
            'status' => $this->faker->randomElement(['Công bố', 'Bản nháp']),
            'slug' => $this->faker->slug(5),
            'category_id' => $this->faker->numberBetween(1, 10),
            'view' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
