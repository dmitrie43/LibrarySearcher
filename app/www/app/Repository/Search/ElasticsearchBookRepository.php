<?php

namespace App\Repository\Search;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Elastic\Elasticsearch\Client;

class ElasticsearchBookRepository implements ISearchBookRepository
{
    /**
     * @var Client
     */
    private Client $elasticsearch;

    /**
     * ElasticsearchBookRepository constructor.
     * @param Client $elasticsearch
     */
    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * @param string $query
     * @return Collection
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    public function search(string $query): Collection
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    /**
     * @param string $query
     * @return \Elastic\Elasticsearch\Response\Elasticsearch|\Http\Promise\Promise
     * @throws \Elastic\Elasticsearch\Exception\ClientResponseException
     * @throws \Elastic\Elasticsearch\Exception\ServerResponseException
     */
    private function searchOnElasticsearch(string $query)
    {
        $model = new Book();
        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['name^5', 'description'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollection($items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Book::findMany($ids)
            ->sortBy(function ($id) use ($ids) {
                return array_search($id->getKey(), $ids);
            });
    }
}
