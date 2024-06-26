<?php

namespace App\Http\Controllers\Auth;

use App\Http\ApiResponseHelperTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResendEmailVerificationController
{
    use ApiResponseHelperTrait;
    public function __invoke(Request $request): JsonResponse
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
        }

        return $this->respondNoContent();
    }
}