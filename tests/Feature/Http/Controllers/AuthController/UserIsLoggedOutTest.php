<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class userIsLoggedOutTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsLoggedOut()
    {
        Artisan::call('passport:install');
        $this->postJson('/auth/register', [
            'name' => 'igor',
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation'=>'password'
        ]);

        $response = $this->postJson('/auth/login', [
            'email' => 'example@example.com',
            'password' => 'password'
        ]);
        $response = $this->get('auth/logout?token=' . $response->json('token'));

        $response->assertOk();
    }
}
