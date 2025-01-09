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
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IBookRepository::class, BookRepository::class);
        $this->app->bind(IAuthorRepository::class, AuthorRepository::class);
        $this->app->bind(IGenreRepository::class, GenreRepository::class);
        $this->app->bind(IPublisherRepository::class, PublisherRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);

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
