<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $publishers = [
            'Эксмо',
            'АСТ',
            'Питер',
        ];
        foreach ($publishers as $publisher) {
            DB::table('publishers')->insert([
                'name' => $publisher,
            ]);
        }
    }
}
