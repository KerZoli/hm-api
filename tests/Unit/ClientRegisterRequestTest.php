<?php

namespace Tests\Unit;

use App\Http\Requests\ClientRegisterRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ClientRegisterRequestTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_validation(): void
    {
        $request = new ClientRegisterRequest();

        $validated = Validator::make([], $request->rules());

        $this->assertFalse($validated->passes());
        $this->assertArrayHasKey('username', $validated->errors()->toArray());
        $this->assertArrayHasKey('email', $validated->errors()->toArray());
        $this->assertArrayHasKey('password', $validated->errors()->toArray());
        $this->assertArrayHasKey('phone', $validated->errors()->toArray());
    }
}
