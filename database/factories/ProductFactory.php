<?php

namespace Database\Factories;

use Domain\Catalog\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2,true)),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'thumbnail' => $this->faker->fixturesImage('products', 'products'),
            'on_home_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999), 
            
            // 'thumbnail' => $this->faker->file(
            //     base_path('tests/Fixtures/images/products'),
            //     storage_path('/app/public/images/products'),
            //     false
            // ),
            'price' => $this->faker->numberBetween(10000, 100000),
            'text' => $this->faker->text(),
        ];
    }
}
