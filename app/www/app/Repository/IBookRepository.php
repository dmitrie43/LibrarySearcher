<?php

namespace App\Repository;

use App\Models\Book;
use Illuminate\Support\Collection;

interface IBookRepository
{
    public function all(): Collection;
}
