<?php

use Illuminate\Database\Seeder;
use App\Post;
use Faker\Generator as Faker;
use App\User;

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
            'title' => $title,
            'description' => $faker->text(),
            'slug' => Post::genSlug($title),
        ]);

        for ($i=0; $i < 200 ; $i++) {
            $title = $faker->word(4, true);
            Post::create([
                'user_id'=> User::inRandomOrder()->first()->id,
                'title' => $title,
                'description' => $faker->text(),
                'slug' => Post::genSlug($title),
            ]);
        }
    }
}
