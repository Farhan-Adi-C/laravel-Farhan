<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'writer' => $this->faker->name, 
            'title' => $this->faker->sentence, 
            'user_id' => User::inRandomOrder()->first()->id, 
            'content' => $this->faker->paragraphs(3, true), 
            'slug' => $this->faker->slug, 
            'featured_image' => 'blog_images\hMQbdynKC7xHl44nykxy2Ev7E8iIYo9VajiDi9pX.jpg', 
        ];
    }
}
