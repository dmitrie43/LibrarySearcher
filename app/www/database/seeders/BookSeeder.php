<?php

namespace Database\Seeders;

use App\Models\Book;
use Database\Factories\AuthorFactory;
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
    public static function run()
    {
        $books = Book::factory()
            ->count(200)->make();
        foreach ($books as $book) {
            $book->author_id = mt_rand(1, 5);
            $book->publisher_id = mt_rand(1, 3);
            $book->save();
            $genres = range(1, mt_rand(1, 5));
            $book->genres()->attach($genres);
        }
    }
}
