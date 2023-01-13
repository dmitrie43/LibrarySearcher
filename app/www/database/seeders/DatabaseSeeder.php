<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        AuthorSeeder::run();
        PublisherSeeder::run();
        GenreSeeder::run();
        RoleSeeder::run();
        BookSeeder::run();
    }
}
