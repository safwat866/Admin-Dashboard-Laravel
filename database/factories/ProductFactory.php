<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Products::class;


    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word(),  // Generate a random product name
            'product_description' => $this->faker->sentence(),  // Random description
            'product_price' => $this->faker->randomFloat(2, 100, 1000),  // Random price
            'product_image' => 'https://m.media-amazon.com/images/I/71CSc3M2AGL._AC_SX679_.jpg'
        ];
    }
}
