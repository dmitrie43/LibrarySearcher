<?php

namespace App\Providers;

use App\Repository\Search\ElasticsearchBookRepository;
use App\Repository\Search\ISearchBookRepository;
use App\Repository\Search\SearchBookRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (! config('services.search.enabled')) {
            $this->app->bind(ISearchBookRepository::class, SearchBookRepository::class);
        } else {
            $this->app->bind(ISearchBookRepository::class, ElasticsearchBookRepository::class);
        }

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function () {
            return ClientBuilder::create()
                ->setHosts($this->app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
