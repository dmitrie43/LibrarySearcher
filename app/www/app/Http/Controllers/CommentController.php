<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use App\Models\Dto\CommentDto;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function setReview(SetReviewRequest $request, string $type): RedirectResponse
    {
        $reviewData = $request->validated() + compact('type');

        dispatch(new CreateReview(new CommentDto(
            theme: $reviewData['theme'],
            text: $reviewData['text'],
            type: $reviewData['type'],
            itemId: $reviewData['item_id'],
            userId: $request->user()->id,
            isRecommended: isset($reviewData['is_recommended']),
        )));

        return back();
    }
}
