<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        ];
        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre,
            ]);
        }
    }
}
