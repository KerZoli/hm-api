<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponseHelpers;

    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->respondWithSuccess(new UserResource(Auth::user()));
        }

        return $this->respondError('Invalid credentials.');
    }
}
