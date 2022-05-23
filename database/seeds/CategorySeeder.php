<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj = [
            [
                'name' => 'Curiosita',
                'description' => 'Tutte le curiosita del momento',
            ],
            [
                'name' => 'Politica',
                'description' => 'Notizie di politica e politica globale',
            ],
            [
                'name' => 'Tecnologia',
                'description' => 'Notizie sui progressi tecnologici',
            ],
            [
                'name' => 'Sport',
                'description' => 'Notizie su qualsiasi sport',
            ],
            [
                'name' => 'Astronomia',
                'description' => 'Notizie e scoperte astronomiche',
            ],
            [
                'name' => 'Istruzione',
                'description' => 'Notizie e aggiornamenti nel settore scolastico',
            ],
            [
                'name' => 'Medicina',
                'description' => 'Notizie e scoperte nella medicina',
            ],
        ];

        foreach ($obj as $item) {
            Category::create($item);
        };
    }
}
