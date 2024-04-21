<?php

namespace App\Http\Controllers\Auth;

use App\Http\ApiResponseHelperTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController
{
    use ApiResponseHelperTrait;

    public function __invoke(Request $request): JsonResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->respondNoContent();
    }
}