<?php

namespace App\Providers;

use App\Repository\Eloquent\AuthorRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\BookRepository;
use App\Repository\Eloquent\CommentRepository;
use App\Repository\Eloquent\GenreRepository;
use App\Repository\Eloquent\PublisherRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\ICommentRepository;
use App\Repository\IEloquentRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use App\Repository\IUserRepository;
use App\Repository\Search\ElasticsearchBookRepository;
use App\Repository\Search\ISearchBookRepository;
use App\Repository\Search\SearchBookRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        IEloquentRepository::class => BaseRepository::class,
        IBookRepository::class => BookRepository::class,
        IAuthorRepository::class => AuthorRepository::class,
        IGenreRepository::class => GenreRepository::class,
        IPublisherRepository::class => PublisherRepository::class,
        IUserRepository::class => UserRepository::class,
        ICommentRepository::class => CommentRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (!config('services.search.enabled')) {
            $this->app->bind(ISearchBookRepository::class, SearchBookRepository::class);
        } else {
            $this->app->bind(ISearchBookRepository::class, ElasticsearchBookRepository::class);
            $this->bindSearchClient();
        }
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
