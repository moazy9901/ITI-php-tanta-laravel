<?php

namespace Database\Factories;

use App\Models\User;
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
        $name = $this->faker->unique()->word(2,true);
        return [
            'slug'=>Str::slug($name),
            'description'=>$this->faker->sentence(8),
            'image'=>'fakImage.avif' . $this->faker->image('public/storage/categories/', 600, 400, null, false),
            'created_by'=>User::inRandomOrder()->first()->id
        ];
    }
}
