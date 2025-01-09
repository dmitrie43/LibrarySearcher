<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\SectionComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessFormReview implements ShouldQueue
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
            DB::transaction(function () {
                // TODO morph
                $review = Comment::create([
                    'theme' => $this->reviewData['theme'],
                    'text' => $this->reviewData['text'],
                    'recommended' => isset($this->reviewData['recommended']) ? '1' : '0',
                    'item_id' => $this->reviewData['item_id'],
                ]);
                $review->user_id = Auth::id();
                $section = SectionComment::query()
                    ->where('name', $this->reviewData['section'])
                    ->firstOrFail();
                $review->section = $section->id;
                $review->save();
            });
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }
}
