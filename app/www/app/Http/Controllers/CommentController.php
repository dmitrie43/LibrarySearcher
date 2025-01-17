<?php

namespace App\Http\Controllers;

use App\Events\ReviewCreate;
use App\Http\Requests\Comments\IndexRequest;
use App\Http\Requests\Comments\SetReviewRequest;
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
        // TODO auth check in gate
        event(new ReviewCreate($request->validated()));

        return back();
    }
}
