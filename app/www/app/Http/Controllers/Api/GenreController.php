<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\IGenreRepository;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    private IGenreRepository $genreRepository;

    public function __construct(
        IGenreRepository $genreRepository
    ) {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        try {
            $request->validate([
                'id' => ['nullable', 'integer'],
                'limit' => ['nullable', 'integer'],
            ]);

            $limit = isset($request->limit) ? $request->limit : 10;

            if ($request->has('id')) {
                $genres = $this->genreRepository->find($request->get('id'));
            } else {
                $genres = $this->genreRepository->all()->take($limit);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'genres' => $genres,
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
