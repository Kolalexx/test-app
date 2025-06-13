<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'status' => 'new',
            'comment' => $this->faker->optional()->paragraph,
        ];
    }
}
