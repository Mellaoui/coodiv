<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Matiere;
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
            'category_id' => Category::all()->random()->id,
            'matiere_id' => Matiere::all()->random()->id,

            'reference' => fake()->text(10),
            'designation' => fake()->text(20),
            'buy_price' => fake()->numberBetween(100, 1000),
            'sell_price' => fake()->numberBetween(100, 1000),
            'weight' => fake()->numberBetween(100, 1000),
            'discount' => fake()->numberBetween(0, 100),
            'quantity' => fake()->numberBetween(0, 100),
        ];
    }
}
