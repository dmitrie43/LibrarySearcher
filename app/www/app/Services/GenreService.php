<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GenreService extends BaseModelService
{
    public function getList(array $filter = []): Collection|LengthAwarePaginator
    {
        $relations = ! empty($filter['relations']) ?
            explode(',', $filter['relations']) :
            [];
        $builder = Genre::query()->with($relations);

        if (! empty($filter['id'])) {
            $builder->where('id', $filter['id']);
        }

        $this->options($builder, $filter);

        return isset($filter['paginate']) ? $builder->paginate($filter['paginate']) : $builder->get();
    }
}
