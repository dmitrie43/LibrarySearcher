<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Collection;

class CommentService
{
    public function getComments(int $item_id, int $section_id): Collection
    {
        //TODO morph
        return Comment::query()
            ->with(['user'])
            ->where('section', $section_id)
            ->where('item_id', $item_id)
            ->where('is_approved', 1)
            ->get();
    }
}
