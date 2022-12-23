<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Repository\IBookRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private IBookRepository $bookRepository;

    public function __construct(
        IBookRepository $bookRepository
    )
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $noveltyBooks = $this->bookRepository->getNovelties(3);

        return view('index', compact('noveltyBooks'));
    }
}
