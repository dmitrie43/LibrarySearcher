<?php

namespace App\Providers;

use App\Repository\Eloquent\AuthorRepository;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\BookRepository;
use App\Repository\Eloquent\GenreRepository;
use App\Repository\Eloquent\PublisherRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\IEloquentRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use App\Repository\IUserRepository;
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
