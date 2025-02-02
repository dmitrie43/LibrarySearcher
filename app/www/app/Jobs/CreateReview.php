<?php

namespace App\Jobs;

use App\Models\Dto\CommentDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly CommentDto $commentDto
    ) {}

    public function handle()
    {
        try {
            /** @var Model $class */
            $class = Relation::getMorphedModel($this->commentDto->type);
            if (! $class) {
                throw new \Exception('Class not found');
            }

            $model = $class::query()->findOrFail($this->commentDto->itemId);

            $model->comments()->create([
                'theme' => $this->commentDto->theme,
                'text' => $this->commentDto->text,
                'is_recommended' => $this->commentDto->isRecommended,
                'user_id' => $this->commentDto->userId,
            ]);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }
}
