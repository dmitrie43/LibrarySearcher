<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Genres\IndexRequest;
use App\Services\GenreService;
use Illuminate\Http\JsonResponse;

class GenreController extends ApiController
{
    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $genres = (new GenreService())->getList(array_merge($request->validated(), [
                'limit' => $limit,
            ]));

            return $this->successResponse([
                'genres' => $genres,
            ]);
        } catch (\Throwable $throwable) {
            return $this->errorResponse($throwable->getMessage());
        }
    }
}
