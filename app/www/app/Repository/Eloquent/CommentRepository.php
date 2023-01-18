<?php

namespace App\Repository\Eloquent;

use App\Models\Comment;
use App\Repository\ICommentRepository;
use Illuminate\Support\Collection;

class CommentRepository extends BaseRepository implements ICommentRepository
{
    /**
     * GenreRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Comment $comment
     */
    public function remove(Comment $comment) : void
    {
        $comment->delete();
    }

    /**
     * @param int $item_id
     * @param int $section_id
     * @return Collection
     */
    public function getComments(int $item_id, int $section_id) : Collection
    {
        return $this->model->where('section', $section_id)->where('item_id', $item_id)->with('user')->get();
    }
}
