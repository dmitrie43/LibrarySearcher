<?php

namespace App\Http\Controllers;

use App\Models\SectionComment;
use App\Repository\IAuthorRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private IAuthorRepository $authorRepository;

    public function __construct(IAuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request) : View
    {
        $authors = $this->authorRepository->paginate($this->authorRepository::PAGINATE);

        return view('/authors/index', compact('authors'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function detail(int $id) : View
    {
        $author = $this->authorRepository->find($id);

        return view('/authors/detail', compact('author'));
    }
}
