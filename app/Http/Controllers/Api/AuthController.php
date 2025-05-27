<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthServices;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    protected $authService;

    public function __construct(AuthServices $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $user  = $this->authService->create($request->all());
        $success['user'] = $user;
        $token = $user->createToken('ApiToken')->plainTextToken;
        $success['token'] = $token;

        return $this->sendResponse($success, 'data');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->attempt($request->all())) {
            /** @var \App\Models\User $user TypeCasting for intelephense using phpDoc */
            $user =  Auth::user();

            $user->tokens()->delete();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['user'] =  $user;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
