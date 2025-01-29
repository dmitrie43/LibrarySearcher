<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Books\IndexRequest;
use App\Http\Resources\BookIndexResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends ApiController
{
    public function index(IndexRequest $request): JsonResponse|AnonymousResourceCollection
    {
        try {
            $limit = $request->input('limit', 10);

            $books = (new BookService)->getList(array_merge($request->validated(), [
                'limit' => $limit,
            ]));

            return BookIndexResource::collection($books);
        } catch (\Throwable $throwable) {
            return $this->errorResponse($throwable->getMessage());
        }
    }
}
