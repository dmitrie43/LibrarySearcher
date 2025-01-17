<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\IndexRequest;
use App\Repository\Search\ISearchBookRepository;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function __construct(
        private ISearchBookRepository $searchBookRepository
    ) {}

    public function index(IndexRequest $request): View
    {
        $books = new Collection;
        if ($request->has('query') && $request->filled('query')) {
            $books = $this->searchBookRepository->search($request->get('query'));
        }

        return view('search', compact('books'));
    }
}
