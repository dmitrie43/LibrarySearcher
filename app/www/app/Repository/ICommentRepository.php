<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ICommentRepository
{
    public function getComments(int $item_id, int $section_id) : Collection;
}
