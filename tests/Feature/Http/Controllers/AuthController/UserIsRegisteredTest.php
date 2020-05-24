<?php

namespace Tests\Feature\Http\Controllers\AuthController;

use App\Repositories\EloquentCityRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Mockery;
use Tests\TestCase;

class UserIsRegisteredTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsRegistered()
    {
        Artisan::call('passport:install');

        $this->instance(User::class, Mockery::mock(User::class, function ($mock) {
            $mock->shouldReceive('create')->once();
        }));

        $this->postJson('/auth/register', [
            'name' => 'igor',
            'email' => 'example@example.com',
            'password' => 'password',
            'password_confirmation'=>'password'
        ]);
    }
}
