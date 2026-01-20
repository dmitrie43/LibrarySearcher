<?php

namespace App\Services\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnection
{
    private static AMQPStreamConnection $connection;

    public function __construct(array $config)
    {
        self::setConnection($config);
    }

    private static function setConnection($config): void
    {
        static::$connection = new AMQPStreamConnection(
            $config['host'],
            $config['port'],
            $config['user'],
            $config['password']
        );
    }

    public static function getConnection(): AMQPStreamConnection
    {
        return static::$connection;
    }
}
