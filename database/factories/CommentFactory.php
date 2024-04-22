<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // value generates a number random from 1 to 5
            'value' => $this->faker->numberBetween($min=1,$max=5),
            // The description will be a real text with 255 of longitude
            'description' => $this->faker->realText(255),
            // user_id that takes any user as if there was commented
            'user_id' => User::all()->random()->id,
            
            'article_id' => Article::all()->random()->id,
        ];
    }
}
