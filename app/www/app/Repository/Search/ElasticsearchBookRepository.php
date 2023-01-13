<?php

namespace App\Repository\Search;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Elastic\Elasticsearch\Client;

class ElasticsearchBookRepository extends SearchRepository implements ISearchBookRepository
{
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function search(string $query) : Collection
    {
        return $this->model->defaultSearch($query);
    }
}
