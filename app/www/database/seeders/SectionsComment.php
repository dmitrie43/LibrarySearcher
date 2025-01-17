<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsComment extends Seeder
{
    //TODO morph
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $sections = [
            'news',
            'books',
        ];
        foreach ($sections as $section) {
            DB::table('sections_comments')->insert([
                'name' => $section,
            ]);
        }
    }
}
