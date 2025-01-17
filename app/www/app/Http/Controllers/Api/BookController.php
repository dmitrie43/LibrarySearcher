<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Books\IndexRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;

class BookController extends ApiController
{
    /**
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request): JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $books = (new BookService())->getList(array_merge($request->validated(), [
                'limit' => $limit,
            ]));

            return $this->successResponse([
                'books' => $books,
            ]);
        } catch (\Throwable $throwable) {
            return $this->errorResponse($throwable->getMessage());
        }
    }
}
