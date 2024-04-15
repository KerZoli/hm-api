<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseHelperTrait {
    public function respondOk(array|JsonResource $data, int $code = Response::HTTP_OK): JsonResponse
    {
        return $this->apiResponse($data, $code);
    }

    public function respondError(string $error = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, $detail = []): JsonResponse
    {
        return $this->apiResponse([
            'message' => $error,
        ], $statusCode);
    }

    private function apiResponse(array $data, int $code): JsonResponse
    {
        return response()->json($data, $code);
    }
}
