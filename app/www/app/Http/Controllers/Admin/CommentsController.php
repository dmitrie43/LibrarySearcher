<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\ICommentRepository;

class CommentsController extends Controller
{
    private ICommentRepository $commentRepository;

    public function __construct(ICommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = $this->commentRepository->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Approve comment to showing
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $comment = $this->commentRepository->find($id);
        $comment->is_approved = 1;
        $comment->save();

        return redirect()->route('admin_panel.comments.index');
    }

    /**
     * Disapprove comment to showing
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disapprove($id)
    {
        $comment = $this->commentRepository->find($id);
        $comment->is_approved = 0;
        $comment->save();

        return redirect()->route('admin_panel.comments.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $comment = $this->commentRepository->find($id);
        $this->commentRepository->remove($comment);

        return redirect()->route('admin_panel.comments.index');
    }
}
