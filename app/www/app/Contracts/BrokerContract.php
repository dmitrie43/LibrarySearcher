<?php

namespace App\Contracts;

use App\Models\Dto\UserDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BrokerContract
{
    public function sendUser(string $message, array $params = []);

    public function receiveUser();
}
