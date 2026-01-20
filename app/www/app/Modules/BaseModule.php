<?php

namespace App\Modules;

use App\Contracts\BrokerContract;

abstract class BaseModule
{
    public function __construct(
        protected BrokerContract $brokerService
    ) {}
}
