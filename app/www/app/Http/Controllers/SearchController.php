<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Book;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(SearchRequest $request): View
    {
        $books = Book::search($request->input('query', ''))->get();

        return view('search', compact('books'));
    }
}
