<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function setReview(SetReviewRequest $request, string $type): RedirectResponse
    {
        dispatch(new CreateReview($request->validated() + compact('type')));

        return back();
    }
}
