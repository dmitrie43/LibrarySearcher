<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\SectionComment;
use App\Models\User;
use App\Repository\IAuthorRepository;
use App\Repository\IBookRepository;
use App\Repository\ICommentRepository;
use App\Repository\IGenreRepository;
use App\Repository\IPublisherRepository;
use App\Repository\IUserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    private IBookRepository $bookRepository;
    private IGenreRepository $genreRepository;
    private IAuthorRepository $authorRepository;
    private IPublisherRepository $publisherRepository;
    private ICommentRepository $commentRepository;
    private IUserRepository $userRepository;

    public function __construct(
        IBookRepository $bookRepository,
        IGenreRepository $genreRepository,
        IAuthorRepository $authorRepository,
        IPublisherRepository $publisherRepository,
        ICommentRepository $commentRepository,
        IUserRepository $userRepository
    )
    {
        $this->bookRepository = $bookRepository;
        $this->genreRepository = $genreRepository;
        $this->authorRepository = $authorRepository;
        $this->publisherRepository = $publisherRepository;
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
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
        $section = SectionComment::where('name', 'books')->first();
        $reviews = $this->commentRepository->getComments($id, intval($section->id));
        $is_favorite = Auth::user() ? $this->userRepository->isBookFavorite(Auth::user(), $id) : false;

        return view('/books/detail', compact('book', 'popularBooks', 'reviews', 'is_favorite'));
    }

    /**
     * @return View
     */
    public function random() : View
    {
        $book = $this->bookRepository->getRandomBook();

        return view('/books/random', compact('book'));
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function set_favorite(Request $request)
    {
        $request->validate([
            'book_id' => ['required', 'integer'],
        ]);

        $book_id = (int) $request->post('book_id');
        $user = $request->user();

        $is_favorite = false;
        try {
            $is_favorite = $this->userRepository->setFavoriteBook($user, $book_id);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

        return json_encode([
            'is_favorite' => $is_favorite
        ]);
    }
}
