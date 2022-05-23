<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;
use App\Category;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $title = 'Come Cucire';
        Post::create([
            'user_id'=> User::inRandomOrder()->first()->id,
            'category_id' => 1,
            'title' => $title,
            'description' => $faker->text(),
            'slug' => Post::genSlug($title),
        ]);

        for ($i=0; $i < 200 ; $i++) {
            $title = $faker->word(4, true);
            Post::create([
                'user_id'=> User::inRandomOrder()->first()->id,
                'category_id' => Category::inRandomOrder()->first()->id,
                'title' => $title,
                'description' => $faker->text(),
                'slug' => Post::genSlug($title),
            ]);
        }
    }
}
