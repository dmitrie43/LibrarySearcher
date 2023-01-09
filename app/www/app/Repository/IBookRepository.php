<?php

namespace App\Repository;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\UploadedFile;

interface IBookRepository
{
    public function getByAuthor(Author $author);

    public function getByPublisher(Publisher $publisher);

    public function getByGenre(Genre $genre, int $limit);

    public function getNovelties($limit);

    public function getPopular($limit);

    public function getDefaultPathCoverImg();

    public function getDefaultCoverImg(): UploadedFile;

    public function uploadCoverImg(UploadedFile $image);

    public function removeCoverImg(Book $book);

    public function genres();
}
