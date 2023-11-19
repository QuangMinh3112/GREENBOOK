<?php

namespace Database\Factories;

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
            'image' => $this->faker->imageUrl(),
            'detail_image' => $this->faker->numberBetween(1, 20),
            'price' => $this->faker->numberBetween(50, 100) * 1000,
            'author' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph(10),
            'short_description' => $this->faker->paragraph(3),
            'slug' => $this->faker->slug(6),
            'published_company' => $this->faker->name(),
            'published_year' => $this->faker->numberBetween(1950, date('Y')),
            'width' => $this->faker->numberBetween(15, 20),
            'height' => $this->faker->numberBetween(10, 13),
            'quantity' => $this->faker->numberBetween(10, 150),
            'status' => $this->faker->numberBetween(0, 1),
            'sale' => $this->faker->numberBetween(0, 1),
            'number_of_pages' => $this->faker->numberBetween(100, 300),
        ];
    }
}
