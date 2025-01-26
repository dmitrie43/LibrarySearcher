<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use Illuminate\Http\JsonResponse;

class CommentController extends ApiController
{
    public function setReview(SetReviewRequest $request, string $type): JsonResponse
    {
        dispatch(new CreateReview($request->validated() + compact('type')));

        return $this->successResponse();
    }
}
