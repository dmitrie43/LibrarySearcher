<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\User;
use App\Observers\AuthorObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Author::observe(AuthorObserver::class);
        User::observe(UserObserver::class);
    }
}
