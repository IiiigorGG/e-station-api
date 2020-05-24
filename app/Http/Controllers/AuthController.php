<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationFailedException;
use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentPositionRepository;
use App\Repositories\EloquentStationRepository;
use App\Http\Resources\User as UserResource;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        if($validator->fails()){
            throw new ValidationFailedException($validator->getMessageBag()->first());
        }

        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'status' => 'ERROR',
                'content'=>'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addMonth(1);
        $token->save();
        return response()->json([
            'token' => $tokenResult->accessToken
        ],200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out!'
        ],200);
    }


    public function user(Request $request)
    {
        return response()->json(array(
            'user'=>new UserResource($request->user())
        ));
    }
}
