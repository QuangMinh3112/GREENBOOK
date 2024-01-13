<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'name' => $this->faker->name(),
            'detail_image' => $this->faker->numberBetween(1, 20),
            'author' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 6),
            'description' => $this->faker->paragraph(10),
            'short_description' => $this->faker->paragraph(3),
            'slug' => $this->faker->slug(6),
            'published_year' => $this->faker->numberBetween(1950, 2000),
            'length' => $this->faker->numberBetween(15, 20),
            'width' => $this->faker->numberBetween(10, 13),
            'status' => $this->faker->numberBetween(0, 1),
            'number_of_pages' => $this->faker->numberBetween(100, 300),
            'view' => $this->faker->numberBetween(10, 1000),
            'created_at' => $this->faker->dateTimeBetween(Carbon::now()->subMonth(2), Carbon::now()),
        ];
    }
}
