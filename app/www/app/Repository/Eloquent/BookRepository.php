<?php

namespace App\Repository\Eloquent;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Repository\IBookRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookRepository extends BaseRepository implements IBookRepository
{
    public string $cover_img = '';
    public string $file = '';
    private string $default_img = 'img/template.jpg';

    const PAGINATE = 20;

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
     * @param bool $withAuthor
     * @return mixed
     */
    public function getByGenre(Genre $genre, int $limit, bool $withAuthor)
    {
        $model = $this->model::whereHas('genres', function($q) use ($genre) {
            $q->where('genre_id', $genre->id);
        });
        $model = $withAuthor ? $model->with('author') : $model;
        return $model->limit($limit)->get();
    }

    /**
     * @param $limit
     * @return mixed
     */
    public function getNovelties($limit)
    {
        return $this->model::where('novelty', '1')->orderBy('date_publish', 'desc')->limit($limit)->get();
    }

    /**
     * @param int $limit
     * @param bool $withAuthor
     * @return mixed
     */
    public function getPopular(int $limit, bool $withAuthor = false)
    {
        $model = $this->model::where('popular', '1');
        $model = $withAuthor ? $model->with('author') : $model;
        return $model->limit($limit)->get();
    }

    /**
     * @return string|null
     */
    public function getDefaultPathCoverImg() : ?string
    {
        return $this->default_img;
    }

    /**
     * @param string $path
     */
    public function setDefaultPathCoverImg(string $path) : void
    {
        $this->default_img = $path;
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
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function uploadFile(UploadedFile $file) : void
    {
        if ($file == null) return;
        $filename = Str::random(10) . '.' . $file->extension();
        $file->storeAs('storage/', $filename);
        $this->file = 'storage/'.$filename;
    }

    /**
     * @param Book $book
     */
    public function removeFile(Book $book) : void
    {
        if (!empty($book->file)) {
            Storage::delete($book->file);
        }
    }

    /**
     * @param Book $book
     */
    public function remove(Book $book) : void
    {
        $this->removeCoverImg($book);
        $this->removeFile($book);
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

    /**
     * @param int $limit
     * @param bool $withAuthor
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBooks(int $limit, bool $withAuthor = false)
    {
        $model = $this->model;
        $model = $withAuthor ? $model->with('author') : $model;
        return $model->limit($limit)->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getBooksByFilter(Request $request)
    {
        $model = $this->model;
        $filters = [
            'genre' => [
                'relation' => 'many',
                'id' => 'genre_id',
                'table' => 'genres',
            ],
            'author' => [
                'relation' => 'single',
                'id' => 'author_id',
            ],
            'publisher' => [
                'relation' => 'single',
                'id' => 'publisher_id',
            ]
        ];

        $model = $model->with('author');

        foreach ($filters as $filter => $arParam) {
            if ($request->has($filter)) {
                if ($arParam['relation'] == 'single') {
                    $model = $model->where($arParam['id'], $request->get($filter));
                } elseif ($arParam['relation'] == 'many') {
                    $value_id = $request->get($filter);
                    $model = $this->model->whereHas($arParam['table'], function($q) use ($value_id, $arParam) {
                        $q->where($arParam['id'], $value_id);
                    });
                }
            }
        }

        if ($request->has('sort') && $request->has('sortBy')) {
            $sort = !empty($request->get('sort')) ? $request->get('sort') : 'ASC';
            $model = $model->orderBy($request->get('sortBy'), $sort);
        }

        return $model->paginate(self::PAGINATE)->withQueryString();
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function getBook(int $id, array $params = [])
    {
        $model = $this->model->where('id', $id);

        if (isset($params['with'])) {
            foreach ($params['with'] as $relation) {
                switch ($relation) {
                    case 'author':
                    case 'publisher':
                    case 'genres':
                        $model = $model->with($relation);
                        break;
                }
            }
        }

        return $model->first();
    }

    public function getRandomBook()
    {
        return $this->model->all()->random(1)->first();
    }
}
