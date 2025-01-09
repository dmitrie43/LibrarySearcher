<?php

namespace App\Listeners;

use App\Events\ReviewCreate;
use App\Jobs\ProcessFormReview;

class ReviewCreateListener
{
    /**
     * Handle the event.
     */
    public function handle(ReviewCreate $event): void
    {
        ProcessFormReview::dispatch($event->reviewData);
    }
}
