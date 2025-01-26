<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\IndexRequest;
use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\CreateReview;
use App\Models\SectionComment;
use App\Services\CommentService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function index(IndexRequest $request): View
    {
        $section = SectionComment::query()->where('name', $request->section)->firstOrFail();
        $comments = (new CommentService)->getComments($request->input('item_id'), intval($section->id));

        return view('comments.index', compact('comments'));
    }

    public function setReview(SetReviewRequest $request): RedirectResponse
    {
        dispatch(new CreateReview($request->validated()));

        return back();
    }
}
