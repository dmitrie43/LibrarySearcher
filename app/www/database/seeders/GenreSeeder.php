<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $genres = [
            'Классика',
            'Ужасы',
            'Фантастика',
            'Романтика',
            'Драма',
        ];
        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
            ]);
        }
    }
}
