<?php

namespace App\Services\RabbitMQ\Internal;

use PhpAmqpLib\Message\AMQPMessage;

class Producer extends RabbitMQBase
{
    public function send(
        string $message,
        string $exchange = '',
        string $routingKey = '',
        array $props = []
    )
    {
        $props = array_merge($props, [
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        $message = new AMQPMessage($message, $props);

        $this->channel->basic_publish($message, $exchange, $routingKey);
    }

}
