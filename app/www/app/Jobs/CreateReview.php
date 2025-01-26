<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CreateReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $reviewData;

    public function __construct(array $reviewData)
    {
        $this->reviewData = $reviewData;
    }

    public function handle()
    {
        try {
            /** @var Model $class */
            $class = Relation::getMorphedModel($this->reviewData['type']);
            if (! $class) {
                throw new \Exception('Class not found');
            }

            $model = $class::query()->findOrFail($this->reviewData['item_id']);

            $model->comments()->create([
                'theme' => $this->reviewData['theme'] ?? '',
                'text' => $this->reviewData['text'] ?? '',
                'is_recommended' => isset($this->reviewData['is_recommended']),
                'user_id' => Auth::id(),
            ]);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }
}
