<?php

namespace App\Services\RabbitMQ\Internal;

use App\Services\RabbitMQ\Enums\ExchangeTypes;
use App\Services\RabbitMQ\RabbitMQConnection;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

abstract class RabbitMQBase
{
    protected AMQPStreamConnection $connection;
    protected AMQPChannel $channel;

    public function __construct(RabbitMQConnection $connection)
    {
        $this->connection = $connection::getConnection();
        $this->channel = $this->connection->channel();
    }

    public function __destruct()
    {
        $this->closeConnections();
    }

    protected function closeConnections(): void
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function setQueue(
        string $queue,
        bool $isPassive = false,
        bool $isDurable = true,
        bool $isExclusive = false,
        bool $isAutoDelete = false,
    ): void
    {
        $this->channel->queue_declare($queue, $isPassive, $isDurable, $isExclusive, $isAutoDelete);
    }

    public function setExchange(
        string $exchange,
        ExchangeTypes $exchangeType,
        bool $isPassive = false,
        bool $isDurable = false,
        bool $isAutoDelete = false,
    ): void
    {
        $this->channel->exchange_declare($exchange, $exchangeType->value, $isPassive, $isDurable, $isAutoDelete);
    }

    public function bindQueue(
        string $queue,
        string $exchange,
        string $routingKey = '',
    ): void
    {
        $this->channel->queue_bind($queue, $exchange, $routingKey);
    }

}
