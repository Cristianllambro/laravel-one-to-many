<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // popolare le tabelle una alla volta partendo dallo user, l'ordine e' importante
        $this->call(UserSeeder::class);
        $this->call(UserInfoSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);

    }
}
