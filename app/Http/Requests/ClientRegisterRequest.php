<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'bio' => ['nullable', 'string'],
            'birth_date' => ['required', 'date'],
        ];
    }
}
