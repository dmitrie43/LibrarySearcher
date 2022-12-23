<?php

namespace App\Repository\Eloquent;

use App\Models\Publisher;
use App\Repository\IPublisherRepository;
use Illuminate\Support\Collection;

class PublisherRepository extends BaseRepository implements IPublisherRepository
{
    /**
     * BookRepository constructor.
     * @param Publisher $model
     */
    public function __construct(Publisher $model)
    {
        parent::__construct($model);
    }
}
