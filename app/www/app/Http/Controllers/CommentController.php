<?php

namespace App\Http\Controllers;

use App\Events\ReviewCreate;
use App\Http\Requests\Comments\IndexRequest;
use App\Http\Requests\Comments\SetReviewRequest;
use App\Models\SectionComment;
use App\Repository\ICommentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private ICommentRepository $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index(IndexRequest $request): View
    {
        $section = SectionComment::where('name', $request->section)->firstOrFail();
        $comments = $this->commentRepository->getComments($request->item_id, intval($section->id));

        return view('comments.index', compact('comments'));
    }

    public function setReview(SetReviewRequest $request): RedirectResponse
    {
        // TODO auth check in gate
        event(new ReviewCreate($request->validated()));

        return back();
    }
}
