<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use App\Models\Dto\CommentDto;
use Illuminate\Http\JsonResponse;

class CommentController extends ApiController
{
    public function setReview(SetReviewRequest $request, string $type): JsonResponse
    {
        $reviewData = $request->validated() + compact('type');

        dispatch(new CreateReview(new CommentDto(
            theme: $reviewData['theme'],
            text: $reviewData['text'],
            type: $reviewData['type'],
            itemId: $reviewData['item_id'],
            userId: $request->user()->id,
            isRecommended: boolval($reviewData['is_recommended'] ?? false),
        )));

        return $this->successResponse();
    }
}
