<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Repository\IBookRepository;
use Illuminate\Support\Collection;

class BookRepository extends BaseRepository implements IBookRepository
{
    /**
     * BookRepository constructor.
     * @param Book $model
     */
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Author $author
     * @return mixed
     */
    public function getByAuthor(Author $author)
    {
        return $this->model::where('author_id', $author->id)->get();
    }

    /**
     * @param Publisher $publisher
     * @return mixed
     */
    public function getByPublisher(Publisher $publisher)
    {
        return $this->model::where('publisher_id', $publisher->id)->get();
    }

    /**
     * @param Genre $genre
     * @return mixed
     */
    public function getByGenre(Genre $genre)
    {
        return $this->model::where('genre_id', $genre->id)->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getNovelties($limit)
    {
        return $this->model::where('novelty', '1')->orderBy('date_publish', 'desc')->take($limit)->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getPopular($limit)
    {
        return $this->model::where('popular', '1')->take($limit)->get();
    }
}
