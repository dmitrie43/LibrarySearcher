<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShowRequest;
use App\Models\User;
use App\Repository\IBookRepository;
use App\Repository\IGenreRepository;
use App\Repository\IUserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private IUserRepository $userRepository,
    ) {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowRequest $request, User $user)
    {
        try {
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
