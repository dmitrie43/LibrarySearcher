<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private IBookRepository $bookRepository;
    private IGenreRepository $genreRepository;
    private IAuthorRepository $authorRepository;
    private IPublisherRepository $publisherRepository;

    public function __construct(
        IBookRepository $bookRepository,
        IGenreRepository $genreRepository,
        IAuthorRepository $authorRepository,
        IPublisherRepository $publisherRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) : View
    {
        $books = $this->bookRepository->getBooksByFilter($request);
        $genres = $this->genreRepository->all();
        $authors = $this->authorRepository->all();
        $publishers = $this->publisherRepository->all();
        $filter_params = [];
        $params = ['genre', 'author', 'publisher'];
        foreach ($params as $param) {
            if ($request->has($param)) {
                $filter_params[$param] = $request->get($param);
            }
        }

        return view('/books/index', compact('books', 'genres', 'authors', 'publishers', 'filter_params'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function detail(int $id) : View
    {
        $params = [
            'with' => [
                'genres',
                'author',
                'publisher',
            ],
        ];
        $book = $this->bookRepository->getBook($id, $params);
        $popularBooks = $this->bookRepository->getPopular(10, true);

        return view('/books/detail', compact('book', 'popularBooks'));
    }

    /**
     * @return View
     */
    public function random() : View
    {
        $book = $this->bookRepository->getRandomBook();

        return view('/books/random', compact('book'));
    }
}
