<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*for ($i = 0; $i < 101; $i++) {
            DB::table('books')->insert([
                'name' => Str::random(10),
                'date_publish' => date('Y-m-d', mt_rand(strtotime('10 September 2000'), strtotime('now'))),
                'pages_quantity' => rand(100, 900),
            ]);
        }*/
        $values = ['0', '1'];
        for ($i = 1; $i <= 101; $i++) {
            DB::table('books')->where('id', $i)->update([
//                'author_id' => rand(1, 10),
//                'publisher_id' => rand(1, 10),
//                'genre_id' => rand(1, 10),
                'novelty' => $values[mt_rand(0, 1)],
                'popular' => $values[mt_rand(0, 1)],
            ]);
        }
    }
}
