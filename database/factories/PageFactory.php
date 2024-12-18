<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->name();
        $slug = Str::slug($title, '-');

        return [
            'admin_id' => rand(1, 5),
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->text(),
            'published_at' => $this->faker->date(),
            'is_status' => rand(0, 1),
        ];
    }
}