<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $reviewData = [];

    public function __construct(array $data)
    {
        $this->reviewData = $data;
    }
}
