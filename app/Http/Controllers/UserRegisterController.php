<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\ApiResponseHelperTrait;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterController extends Controller
{
    use ApiResponseHelperTrait;

    public function __construct(private readonly CreateUser $createUser)
    {}

    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->createUser->execute($request->validated());
        $request->file('avatar')->store('avatars');

        return $this->respondOk(new UserResource($user), Response::HTTP_CREATED);
    }
}