<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $author_id=User::pluck('id')->toArray();
        $name=fake()->name();
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>fake()->text(200),
            'image'=>fake()->imageUrl(),
//            'status'=>fake()->randomElement(['active','archived']),

        ];
    }
}
