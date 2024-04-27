<?php

namespace App\Http\Controllers\Auth;

use App\Http\ApiResponseHelperTrait;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;

class EmailVerificationController
{
    use ApiResponseHelperTrait;
    public function __invoke(EmailVerificationRequest $request): JsonResponse
    {
        $request->fulfill();

        return $this->respondNoContent();
    }
}