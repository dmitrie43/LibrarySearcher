<?php

namespace App\Http\Controllers;

use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use App\Repository\Search\ISearchAuthorRepository;
use App\Repository\Search\ISearchBookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    private ISearchBookRepository $searchBookRepository;
    private ISearchAuthorRepository $searchAuthorRepository;

    public function __construct(
        ISearchBookRepository $searchBookRepository,
        ISearchAuthorRepository $searchAuthorRepository
    )
    {
        $this->searchBookRepository = $searchBookRepository;
        $this->searchAuthorRepository = $searchAuthorRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $books = new Collection();
        $authors = new Collection();

        if ($request->has('query') && $request->filled('query')) {
            $books = $this->searchBookRepository->search($request->get('query'));
            $authors = $this->searchAuthorRepository->search($request->get('query'));
        }

        return view('search', compact('books', 'authors'));
    }
}
