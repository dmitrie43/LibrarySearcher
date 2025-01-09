<?php

namespace App\Http\Controllers;

use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use App\Repository\Search\ISearchBookRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SearchController extends Controller
{
    private IBookRepository $bookRepository;

    private IGenreRepository $genreRepository;

    private IAuthorRepository $authorRepository;

    private IPublisherRepository $publisherRepository;

    private ISearchBookRepository $searchBookRepository;

    public function __construct(
        IBookRepository $bookRepository,
        IGenreRepository $genreRepository,
        IAuthorRepository $authorRepository,
        IPublisherRepository $publisherRepository,
        ISearchBookRepository $searchBookRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
        $this->searchBookRepository = $searchBookRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $books = new Collection;
        if ($request->has('query') && $request->filled('query')) {
            $books = $this->searchBookRepository->search($request->get('query'));
        }

        return view('search', compact('books'));
    }
}
