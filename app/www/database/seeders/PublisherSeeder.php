<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            Publisher::create([
                'name' => $publisher,
            ]);
        }
    }
}
