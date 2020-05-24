<?php

namespace Tests\Feature\Http\Middleware;

use App\Http\Middleware\SetHeaderToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class HeaderTokenIsSetTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHeaderTokenIsSet()
    {
        $request = new Request;

        $request->merge(['token' => 'exampleToken']);

        $middleware = new SetHeaderToken();

        $middleware->handle($request, function ($req) {
            $this->assertEquals('Bearer exampleToken',$req->header('Authorization'));
        });
    }
}
