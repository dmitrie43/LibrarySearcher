<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * @param array $data
     * @return JsonResponse
     */
    public function successResponse(array $data = []): JsonResponse
    {
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public function errorResponse(string $message = '', int $statusCode = 500): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}
