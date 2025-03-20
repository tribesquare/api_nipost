<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait APIResponses {
    protected function ok($message, $data = []): JsonResponse {
        return $this->success($message, $data, 200);
    }

    protected function success($message, $data = [], $statusCode = Response::HTTP_OK): JsonResponse
  {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

    protected function error($message, $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse {
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}