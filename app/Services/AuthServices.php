<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class AuthServices
{
    public function create(array $data): User
    {
        return User::create($data);
    }
    public function attempt(array $credentials): bool
    {
        $remember = isset($credentials['remember']) ? $credentials['remember'] : false;
        unset($credentials['remember']);
        return Auth::attempt($credentials, $remember);
    }
}
