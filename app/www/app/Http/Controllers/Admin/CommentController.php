<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $comments = Comment::query()->orderBy('id', 'DESC')->paginate(20);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function approve(Comment $comment): RedirectResponse
    {
        $comment->update(['is_approved' => 1]);

        return redirect()->route('admin_panel.comments.index');
    }

    /**
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function disapprove(Comment $comment):  RedirectResponse
    {
        $comment->update(['is_approved' => 0]);

        return redirect()->route('admin_panel.comments.index');
    }

    /**
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin_panel.comments.index');
    }
}
