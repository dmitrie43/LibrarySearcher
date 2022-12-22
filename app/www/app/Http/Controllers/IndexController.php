<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repository\IBookRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private IBookRepository $bookRepository;

    public function __construct(IBookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->all();
        return view('index', compact('books'));
    }
}
