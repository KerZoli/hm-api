<?php

namespace App\Actions;

use App\Models\User;

class CreateUser
{
    public function execute(array $data): User
    {
        $user = new User();
        $user->fill($data);
        $user->save();

        return $user;
    }
}
