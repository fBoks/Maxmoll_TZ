<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->unique()->randomElement(Product::all()->pluck('id')->toArray()),
            'warehouse_id' => $this->faker->numberBetween(1, 3),
            'stock' => $this->faker->numberBetween(0, 1000),
        ];
    }

    private function getUniqueId($model)
    {
        $max = $model::all()->count() - 1;
        do {
            $number = $this->faker->numberBetween(0, $max);
        } while ($model::query()->where('id', $number)->exists());

        return $number;
    }
}
