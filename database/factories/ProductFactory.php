<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private int $iteration = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Товар #' . $this->iteration;
        $this->iteration++;

        return [
            'name' => $name,
            'price' => $this->faker->randomFloat(10, 10, 10000),
        ];
    }
}
