<?php

namespace App\Jobs;

use App\Models\SectionComment;
use App\Repository\ICommentRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProcessFormReview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $data;

    protected int $user_id;

    /**
     * ProcessFormReview constructor.
     */
    public function __construct(array $data, int $user_id)
    {
        $this->data = $data;
        $this->user_id = $user_id;
    }

    public function handle(ICommentRepository $commentRepository)
    {
        $request = $this->data;
        $user_id = $this->user_id;
        try {
            DB::transaction(function () use ($commentRepository, $request, $user_id) {
                $review = $commentRepository->create([
                    'theme' => $request['theme'],
                    'text' => $request['text'],
                    'recommended' => isset($request['recommended']) ? '1' : '0',
                    'item_id' => $request['item_id'],
                ]);
                $review->user_id = $user_id;
                $section = SectionComment::where('name', $request['section'])->first();
                if (empty($section)) {
                    throw new NotFound;
                }
                $review->section = $section->id;
                $review->save();
            });
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }
    }
}
