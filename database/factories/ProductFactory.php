<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'name'=>$this->faker->words(3,true),
            'description'=>$this->faker->paragraph(),
            'price'=>$this->faker->randomFloat(2,10, 10000),
            'image'=>'fakImage.avif'.$this->faker->image('public/storage/products/',600,600,null,false),
            'stock_quantity'=>$this->faker->numberBetween(1,200),
            'is_active'=>$this->faker->boolean(),
            'created_by'=>User::inRandomOrder()->first()->id,
            'category_id'=>Category::inRandomOrder()->first()->id
        ];
    }
}
