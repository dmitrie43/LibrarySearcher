<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFormReview;
use App\Models\Comment;
use App\Models\SectionComment;
use App\Repository\ICommentRepository;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    private ICommentRepository $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $section = SectionComment::where('name', $request->section)->firstOrFail();
        $comments = $this->commentRepository->getComments($request->item_id, intval($section->id));

        return view('comments.index', compact('comments'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setReview(Request $request)
    {
        if (!Auth::check()) back();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'theme' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'section' => ['required', 'string'],
            'item_id' => ['required', 'integer']
        ]);

        ProcessFormReview::dispatch($request->all(), Auth::id())->onQueue('form');

        return back();
    }
}
