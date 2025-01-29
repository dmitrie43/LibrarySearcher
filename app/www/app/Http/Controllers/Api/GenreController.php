<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Genres\IndexRequest;
use App\Http\Resources\GenreIndexResource;
use App\Services\GenreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GenreController extends ApiController
{
    public function index(IndexRequest $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $limit = $request->input('limit', 10);

            $genres = (new GenreService)->getList(array_merge($request->validated(), [
                'limit' => $limit,
            ]));

            return GenreIndexResource::collection($genres);
        } catch (\Throwable $throwable) {
            return $this->errorResponse($throwable->getMessage());
        }
    }
}
