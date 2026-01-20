<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentService extends BaseModelService
{
    public function getList(array $filter = []): Collection|LengthAwarePaginator
    {
        $builder = Comment::query();

        if (! empty($filter['is_approved'])) {
            $builder->where('is_approved', $filter['is_approved']);
        }

        $this->options($builder, $filter);

        return isset($filter['paginate']) ? $builder->paginate($filter['paginate'])->withQueryString() : $builder->get();
    }

    public function getApprovedByModel(Model $model): Collection
    {
        return $model
            ->comments()
            ->where('is_approved', true)
            ->get();
    }

    public function getApprovedById(int $id, string $type): Collection
    {
        /** @var Model $model */
        $model = $this->getMorphedModel($type);
        $model = $model::query()->findOrFail($id);

        return $model
            ->comments()
            ->where('is_approved', true)
            ->get();
    }
}
