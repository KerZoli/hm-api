<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\ApiResponseHelperTrait;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterController extends Controller
{
    use ApiResponseHelperTrait;

    public function __construct(private readonly CreateUser $createUser)
    {}

    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $data['avatar'] = $path;
        }

        $user = $this->createUser->execute($data);

        /** @var User $user */
        event(new Registered($user));

        return $this->respondOk(new UserResource($user), Response::HTTP_CREATED);
    }
}