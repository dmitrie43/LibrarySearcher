<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Repository\IBookRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookRepository extends BaseRepository implements IBookRepository
{
    public string $cover_img = '';

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
     * @param int $limit
     * @return mixed
     */
    public function getByGenre(Genre $genre, int $limit)
    {
        return $this->model::whereHas('genres', function($q) use ($genre) {
            $q->where('genre_id', $genre->id);
        })->limit($limit)->get();
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

    /**
     * @return string|null
     */
    public function getDefaultPathCoverImg() : ?string
    {
        return 'img/template.jpg';
    }

    /**
     * @return UploadedFile
     */
    public function getDefaultCoverImg() : UploadedFile
    {
        $file_info = pathinfo($this->getDefaultPathCoverImg());
        return new UploadedFile(
            $this->getDefaultPathCoverImg(),
            $file_info['basename'],
            mime_content_type($this->getDefaultPathCoverImg())
        );
    }

    /**
     * @param \Illuminate\Http\UploadedFile $image
     */
    public function uploadCoverImg(UploadedFile $image) : void
    {
        if ($image == null) return;
        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('storage/', $filename);
        $this->cover_img = 'storage/'.$filename;
    }

    /**
     * @param Book $book
     */
    public function removeCoverImg(Book $book) : void
    {
        if (!empty($book->cover_img)) {
            Storage::delete($book->cover_img);
        }
    }

    /**
     * @param Book $book
     */
    public function remove(Book $book) : void
    {
        $this->removeCoverImg($book);
        $book->genres()->detach();
        $book->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres()
    {
        return $this->model->belongsToMany(Genre::class, 'genre_book', 'book_id', 'genre_id');
    }
}
