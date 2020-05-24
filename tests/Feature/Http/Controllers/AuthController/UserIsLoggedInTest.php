<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use App\Station;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Token;
use Mockery;
use Tests\TestCase;
use Illuminate\Http\Response;

class userIsLoggedInTest extends TestCase
{
    use RefreshDatabase;



    public function testUserIsLoggedIn()
    {
        Artisan::call('passport:install');

        $this->postJson('/auth/register', [
            'name' => 'igor',
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation'=>'password'
        ]);
        $response = $this->postJson('/auth/login', [
            'name'=>'igor',
            'email' => 'example@example.com',
            'password' => 'password'
        ]);

        $response->assertOk();
    }
}
