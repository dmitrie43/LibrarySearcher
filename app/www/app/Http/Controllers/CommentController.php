<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFormReview;
use App\Models\SectionComment;
use App\Repository\ICommentRepository;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $section = SectionComment::where('name', $request->section)->firstOrFail();
        $comments = $this->commentRepository->getComments($request->item_id, intval($section->id));

        return view('comments.index', compact('comments'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setReview(Request $request)
    {
        if (! Auth::check()) {
            back();
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'section' => ['required', 'string'],
            'item_id' => ['required', 'integer'],
        ]);

        ProcessFormReview::dispatch($request->all(), Auth::id());

        return back();
    }
}
