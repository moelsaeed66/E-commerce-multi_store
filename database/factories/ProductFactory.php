<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name=fake()->name();
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>fake()->text(200),
            'image'=>fake()->imageUrl(600,600),
            'price'=>fake()->randomFloat(1,1,499),
            'compare_price'=>fake()->randomFloat(1,500,999),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'store_id'=>Store::inRandomOrder()->first()->id,
            'featured'=>rand(0,1),





        ];
    }
}
