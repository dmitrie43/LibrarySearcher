<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use Illuminate\View\View;

class IndexController extends Controller
{
    private IBookRepository $bookRepository;

    private IGenreRepository $genreRepository;

    public function __construct(
        IBookRepository $bookRepository,
        IGenreRepository $genreRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
    }

    public function index(IndexRequest $request): View
    {
        $noveltyBooks = $this->bookRepository->getNovelties(3);
        $genres = $this->genreRepository->getGenresWithBooks();
        $books = $this->bookRepository->getBooks(6, false);
        $popularBooks = $this->bookRepository->getPopular(10);

        return view('index', compact('noveltyBooks', 'genres', 'books', 'popularBooks'));
    }
}
