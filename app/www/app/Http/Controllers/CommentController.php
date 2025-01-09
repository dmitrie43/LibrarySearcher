<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\IndexRequest;
use App\Http\Requests\Comments\SetReviewRequest;
use App\Jobs\ProcessFormReview;
use App\Models\SectionComment;
use App\Repository\ICommentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private ICommentRepository $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param IndexRequest $request
     * @return View
     */
    public function index(IndexRequest $request): View
    {
        $section = SectionComment::where('name', $request->section)->firstOrFail();
        $comments = $this->commentRepository->getComments($request->item_id, intval($section->id));

        return view('comments.index', compact('comments'));
    }

    /**
     * @param SetReviewRequest $request
     * @return RedirectResponse
     */
    public function setReview(SetReviewRequest $request): RedirectResponse
    {
        if (! Auth::check()) {
            back();
        }

        ProcessFormReview::dispatch($request->all(), Auth::id());

        return back();
    }
}
