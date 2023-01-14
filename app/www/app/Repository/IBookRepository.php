<?php

namespace App\Repository;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface IBookRepository
{
    public function getByAuthor(Author $author);

    public function getByPublisher(Publisher $publisher);

    public function getByGenre(Genre $genre, int $limit, bool $withAuthor);

    public function getNovelties($limit);

    public function getPopular(int $limit, bool $withAuthor = false);

    public function getDefaultPathCoverImg();

    public function getDefaultCoverImg(): UploadedFile;

    public function uploadCoverImg(UploadedFile $image);

    public function removeCoverImg(Book $book);

    public function genres();

    public function getBooks(int $limit, bool $withAuthor);

    public function getBooksByFilter(Request $request);

    public function getBook(int $id, array $params = []);

    public function getRandomBook();
}
