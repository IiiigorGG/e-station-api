<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProtectedRouteAccessAllowedWithTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testProtectedRouteAccessAllowedWithToken()
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

        $stationShowResponse = $this->get('/stations?token=' . $response->json('token'));

        $stationShowResponse->assertOk();
    }
}
