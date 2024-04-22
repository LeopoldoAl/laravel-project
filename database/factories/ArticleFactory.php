<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique->realText(55);
        return [
            'title' => $title,
            // We should imort Str
            'slug' => Str::slug($title),
            'introduction' => $this->faker->realText(255),
            // We pass it where it's saved as 'public/storage/articles'
            // then the image's size as 640 and 480 then we put null then one true or one false
            // What means 'true' faker storages the image like this 'public/storage/articles/photo.png'
            // and 'false' will be 'photo.png'
            // but we wish to create it like this: 'articles/photo.png'
            // image => $this->image('public/storage/articles', null, true),
            'image' => 'articles/'.$this->faker->image('public/storage/articles',640, 480, null, false),
            'body' => $this->faker->text(2000),
            'status' => $this->faker->boolean(),
            // That it wears me all user and choose an ID random
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id, 
        ];
    }
}
