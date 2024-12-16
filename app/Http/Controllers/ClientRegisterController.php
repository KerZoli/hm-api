<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Enums\RolesEnum;
use App\Http\ApiResponseHelperTrait;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ClientRegisterController extends Controller
{
    use ApiResponseHelperTrait;

    public function __construct(private readonly CreateUser $createUser)
    {}

    public function __invoke(ClientRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars');
            $data['avatar'] = $path;
        }

        $user = $this->createUser->execute($data);
        $user->assignRole(RolesEnum::CLIENT);
        Auth::login($user);

        event(new Registered($user));

        return $this->respondOk(new UserResource($user), Response::HTTP_CREATED);
    }
}
