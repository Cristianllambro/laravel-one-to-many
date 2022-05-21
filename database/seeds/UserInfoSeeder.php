<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\UserInfo;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //relazione uno ad uno quindi non prendo gli di random ma ne associo uno solo

        //chiamata di tutti gli utenti
        $eleUsers = User::all();

        //ciclo per assegnari un id unico alla tabella
        foreach ($eleUsers as  $element) {
            UserInfo::create([
                'user_id' => $element->id,
                'phone' => $faker->phoneNumber(),
                'address' =>$faker->address(),
            ]);
        }
    }
}
