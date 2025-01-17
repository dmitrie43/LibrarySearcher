<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService extends BaseService
{
    public function getRandomBook(): ?Book
    {
        return Book::query()->orderByRaw('RAND()')->limit(1)->first();
    }

    public function getList(array $filter = []): Collection|LengthAwarePaginator
    {
        $relations = ! empty($filter['relations']) ?
            explode(',', $filter['relations']) :
            [
                'author',
                'publisher',
                'genres',
            ];
        $builder = Book::query()->with($relations);

        if (! empty($filter['genre_id'])) {
            $builder->whereHas('genres', fn (Builder $query) => $query->whereIn('genres.id', $filter['genre_id']));
        }

        if (! empty($filter['author_id'])) {
            $builder->whereIn('author_id', $filter['author_id']);
        }

        if (! empty($filter['publisher_id'])) {
            $builder->whereIn('publisher_id', $filter['publisher_id']);
        }

        $this->options($builder, $filter);

        return isset($filter['paginate']) ? $builder->paginate($filter['paginate'])->withQueryString() : $builder->get();
    }
}
