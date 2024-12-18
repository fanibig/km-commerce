<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{

    public function definition(): array
    {
        $title = $this->faker->company();
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'status' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'meta_keywords' => $this->faker->words(3, true),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}