<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends ApiController
{
    public function setReview(SetReviewRequest $request, string $type): JsonResponse
    {
        dispatch(new CreateReview($request->validated() + compact('type')));

        return $this->successResponse();
    }
}
