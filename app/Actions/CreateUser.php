<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CreateUser
{
    public function execute(array $data): Model|Builder
    {
        return User::query()->create($data);
    }
}