<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\IndexRequest;
use App\Http\Requests\Comments\IndexRequest as CommentIndexRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Services\BookService;
use App\Services\CommentService;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    public function index(IndexRequest $request): View
    {
        $books = (new BookService)->getList(array_merge($request->validated(), [
            'paginate' => $request->input('paginate', 20),
        ]));

        $genres = Genre::query()->get();
        $authors = Author::query()->get();
        $publishers = Publisher::query()->get();

        $filterParams = $request->validated();

        return view('/books/index', compact('books', 'genres', 'authors', 'publishers', 'filterParams'));
    }

    public function detail(Book $book): View
    {
        $book->load(['author', 'publisher', 'genres']);
        $popularBooks = Book::query()->with(['author'])->popular()->limit(10)->get();
        $reviews = (new CommentService)->getApprovedByModel($book);

        return view('/books/detail', compact('book', 'popularBooks', 'reviews'));
    }

    public function random(): View
    {
        $book = (new BookService)->getRandomBook();

        return view('/books/random', compact('book'));
    }

    public function reviews(CommentIndexRequest $request, Book $book): View
    {
        $reviews = (new CommentService)->getApprovedByModel($book);

        return view('comments.index', compact('reviews'));
    }
}
