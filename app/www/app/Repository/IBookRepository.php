<?php

namespace App\Repository;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Publisher;

interface IBookRepository
{
    public function getByAuthor(Author $author);

    public function getByPublisher(Publisher $publisher);

    public function getByGenre(Genre $genre);

    public function getNovelties($limit);

    public function getPopular($limit);
}
