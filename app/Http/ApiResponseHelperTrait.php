<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseHelperTrait {
    public function respondOk(array|JsonResource $data, int $code = Response::HTTP_OK): JsonResponse
    {
        if ($data instanceof JsonResource) {
            $data = json_decode($data->toJson(), true);
        }

        return $this->apiResponse($data, $code);
    }

    public function respondError(string $error = null, int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->apiResponse([
            'message' => $error,
        ], $statusCode);
    }

    public function respondNoContent(): JsonResponse
    {
        return $this->apiResponse(null, Response::HTTP_NO_CONTENT);
    }

    private function apiResponse(?array $data, int $code): JsonResponse
    {
        return response()->json($data, $code);
    }
}
