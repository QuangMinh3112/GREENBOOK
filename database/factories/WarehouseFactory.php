<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => $this->faker->unique()->numberBetween(1, 100),
            'quantity' => $this->faker->numberBetween(100, 500),
            'import_price' => $this->faker->numberBetween(10, 30) * 1000,
            'retail_price' => $this->faker->numberBetween(70, 100) * 1000,
            'wholesale_price' => $this->faker->numberBetween(30, 70) * 1000,
            'supplier_id' => $this->faker->numberBetween(1, 3),
            'returned_quantity' => $this->faker->numberBetween(0, 20),
            'defective_quantity' => $this->faker->numberBetween(0, 10),
            'delivery_quantity' => $this->faker->numberBetween(10, 300),
            'stock' => $this->faker->numberBetween(0, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
