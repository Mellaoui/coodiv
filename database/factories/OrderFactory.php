<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::all()->random()->id,
            'user_id' => User::all()->random()->id,

            'tracking_number' => fake()->unique()->randomNumber(8, true),
            'quantity' => fake()->numberBetween(1, 100),
            'status' => fake()->randomElement([
                'shipped', 'delivered', 'returned'
            ]),
        ];
    }
}
