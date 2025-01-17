<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @param IndexRequest $request
     * @return View
     */
    public function index(IndexRequest $request): View
    {
        $noveltyBooks = Book::query()->novelty()->limit(3)->get();
        $popularBooks = Book::query()->popular()->limit(10)->get();
        $books = Book::query()->limit(6)->get();
        $genres = Genre::query()->has('books')->get();

        return view('index', compact('noveltyBooks', 'genres', 'books', 'popularBooks'));
    }
}
