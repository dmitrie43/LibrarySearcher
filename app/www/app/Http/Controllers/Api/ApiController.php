<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function successResponse(array $data = []): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ]);
    }

    public function errorResponse(string $message = '', int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
