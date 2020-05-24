<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class userIsReturnedTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsReturned()
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
        $response = $this->get('auth/user?token=' . $response->json('token'));

        $response->assertExactJson([
            'user'=>[
                'name' => 'igor',
                'email' => 'example@example.com'
            ]
        ]);
    }
}
