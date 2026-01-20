<?php

namespace App\Providers;

use App\Contracts\BrokerContract;
use App\Models\Book;
use App\Services\RabbitMQ\RabbitMQConnection;
use App\Services\RabbitMQ\RabbitMQService;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $this->app->singleton(RabbitMQConnection::class, function () {
            return new RabbitMQConnection(config('services.broker.rabbitmq'));
        });

        $this->app->bind(BrokerContract::class, RabbitMQService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** Morph relation alias */
        Relation::morphMap([
            'books' => Book::class,
        ]);
    }
}
