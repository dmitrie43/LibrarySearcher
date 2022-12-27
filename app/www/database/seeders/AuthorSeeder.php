<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $authors = [
            'Анджей Сапковский',
            'Рэй Брэдбери',
            'Стивен Кинг',
            'Ричард Мэтисон',
            'Джордж Оруэлл',
        ];
        foreach ($authors as $author) {
            DB::table('authors')->insert([
                'full_name' => $author,
            ]);
        }
    }
}
