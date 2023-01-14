<?php

namespace App\Repository\Search;

interface ISearchBookRepository
{
    public function search(string $query);
}
