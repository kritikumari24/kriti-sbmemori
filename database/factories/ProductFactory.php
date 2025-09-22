<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'name' => $this->faker->unique()->safeEmail(),
            'quantity' => $this->faker->randomDigit(),
            'price' => $this->faker->numberBetween($min = 150, $max = 600)
        ];
    }
}
