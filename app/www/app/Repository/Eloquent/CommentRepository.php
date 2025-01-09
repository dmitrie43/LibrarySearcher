<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\ICommentRepository;
use Illuminate\Support\Collection;

class CommentRepository extends BaseRepository implements ICommentRepository
{
    /**
     * GenreRepository constructor.
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function remove(Comment $comment): void
    {
        $comment->delete();
    }

    public function getComments(int $item_id, int $section_id): Collection
    {
        return $this->model
            ->where('section', $section_id)
            ->where('item_id', $item_id)
            ->where('is_approved', 1)
            ->with('user')
            ->get();
    }
}
