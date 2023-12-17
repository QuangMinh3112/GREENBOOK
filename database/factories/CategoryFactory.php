<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'description' => $this->faker->paragraph(3),
            'slug' => $this->faker->slug(3),
            'parent_id' => $this->faker->optional()->randomElement([null, $this->faker->numberBetween(1, 10)])
        ];
    }
}
