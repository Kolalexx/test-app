<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'category_id' => Category::factory(),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'description' => $this->faker->paragraph,
        ];
    }
}
