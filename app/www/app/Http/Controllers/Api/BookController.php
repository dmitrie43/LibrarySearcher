<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use Illuminate\Http\Request;

class BookController extends Controller
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        try {
            $request->validate([
                'genre' => ['nullable', 'integer'],
                'limit' => ['nullable', 'integer'],
            ]);

            $limit = isset($request->limit) ? $request->limit : 10;

            if ($request->has('genre')) {
                $genre = $this->genreRepository->find($request->get('genre'));
                $books = $this->bookRepository->getByGenre($genre, $limit, true);
            } else {
                $books = $this->bookRepository->getBooks($limit, true);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'books' => $books,
                ],
            ], 200);
        } catch (\Throwable $throwable) {
            return response()->json([
                'success' => false,
                'message' => $throwable->getMessage(),
            ], 500);
        }
    }
}
