<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ClientRegisterControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_can_register_with_avatar_upload(): void
    {
        Storage::fake('local');
        Event::fake();

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson(route('client.register'), [
            'avatar' => $file,
            'username' => 'Test user',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'phone' => '0321321341',
        ]);

        Event::assertDispatched(Registered::class);

        $response->assertStatus(Response::HTTP_CREATED);
        Storage::disk('local')->assertExists('avatars/' . $file->hashName());
    }
}
