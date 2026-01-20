<?php

namespace App\Services\RabbitMQ;

use App\Contracts\BrokerContract;
use App\Services\RabbitMQ\Enums\Exchanges;
use App\Services\RabbitMQ\Enums\ExchangeTypes;
use App\Services\RabbitMQ\Enums\Queues;
use App\Services\RabbitMQ\Internal\Producer;

class RabbitMQService implements BrokerContract
{
    public function sendUser(string $message, array $params = [])
    {
        /** @var Producer $producer */
        $producer = app(Producer::class);

        $producer->setQueue(Queues::CreateUser->value);
        $producer->setExchange(Exchanges::User->value, ExchangeTypes::Direct);

        $producer->bindQueue(Queues::CreateUser->value, Exchanges::User->value);

        $producer->send($message, Exchanges::User->value, props: $params);
    }

    public function receiveUser()
    {
        
    }

}
