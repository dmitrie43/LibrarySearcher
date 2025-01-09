<?php

namespace App\Repository\Eloquent;

use App\Models\Publisher;
use App\Repository\IPublisherRepository;

class PublisherRepository extends BaseRepository implements IPublisherRepository
{
    /**
     * PublisherRepository constructor.
     */
    public function __construct(Publisher $model)
    {
        parent::__construct($model);
    }

    public function remove(Publisher $publisher): void
    {
        $publisher->delete();
    }
}
