<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

abstract class BaseModelService
{
    const string DEFAULT_ORDER_FIELD = 'id';

    const string DEFAULT_ORDER_DIRECTION = 'asc';

    abstract public function getList(array $filter = []): Collection|LengthAwarePaginator|LazyCollection;

    public function options(Builder $builder, array $params = []): void
    {
        $select = ! empty($params['select']) ? explode(',', $params['select']) : '*';
        $builder->select($select);

        if (! empty($params['limit'])) {
            $builder->limit($params['limit']);
        }

        if (! empty($params['offset'])) {
            $builder->offset($params['offset']);
        }

        $orderBy = $params['orderBy'] ?? self::DEFAULT_ORDER_FIELD;
        $orderByDirection = $params['orderByDirection'] ?? self::DEFAULT_ORDER_DIRECTION;
        $builder->orderBy($orderBy, $orderByDirection);
    }

    public function getMorphedModel(string $type): string
    {
        /** @var string|null $class */
        $class = Relation::getMorphedModel($type);
        if (! $class) {
            throw new \Exception('Class not found');
        }

        return $class;
    }
}
