<?php

namespace App\Services\RabbitMQ\Enums;

enum ExchangeTypes: string
{
    case Fanout = 'fanout';
    case Direct = 'direct';
    case Topic = 'topic';
    case Headers = 'headers';
}
