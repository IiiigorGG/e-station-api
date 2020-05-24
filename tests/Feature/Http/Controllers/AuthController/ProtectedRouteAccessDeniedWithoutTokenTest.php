<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ProtectedRouteAccessDeniedWithoutTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testProtectedRouteAccessDeniedWithoutToken()
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

        $stationShowResponse = $this->get('/stations');

        $stationShowResponse->assertRedirect();
    }
}
