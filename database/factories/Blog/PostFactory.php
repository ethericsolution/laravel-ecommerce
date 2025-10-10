<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'         => $name = $this->faker->unique()->words(3, true),
            'slug'          => Str::slug($name),
            'content'       => $this->faker->paragraph(),
            'published_at'  => now()->format('Y-m-d'),
            'blog_category_id'  => Category::factory(),
            'seo_title'         => $this->faker->realText(60),
            'seo_description'   => $this->faker->realText(160),
            'status'            => $this->faker->randomElement(['draft', 'published']),
            // Timestamps
            'created_at'    => $this->faker->dateTimeBetween('-1 year', '-6 month'),
            'updated_at'    => $this->faker->dateTimeBetween('-5 month', 'now'),
        ];
    }
}
