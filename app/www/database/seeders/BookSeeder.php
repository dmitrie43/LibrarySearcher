<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $books = Book::factory()->count(200)->make();
        $authors = Author::query()->get();
        $publishers = Publisher::query()->get();
        $genres = Genre::query()->get();

        foreach ($books as $book) {
            $book->author_id = $authors->random(1)->first()->id;
            $book->publisher_id = $publishers->random(1)->first()->id;
            $book->save();
            $book->genres()->attach($genres->random(2)->pluck('id'));
        }
    }
}
