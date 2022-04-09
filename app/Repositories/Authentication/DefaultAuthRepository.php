<?php

namespace App\Repositories\Authentication;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class DefaultAuthRepository implements AuthRepository
{

    /**
     * @param array $credentials
     * @return mixed
     * @throws AuthenticationException
     */
    public function login (array $credentials): mixed
    {
        if (!Auth::attempt($credentials))
            throw new AuthenticationException();

        $user = Auth::user();
        return $user->createToken('Laravel Personal Access Client')->accessToken;
    }

    /**
     * @return void
     * @throws AuthenticationException
     */
    public function logout(): void
    {
        if (!Auth::check())
            throw new AuthenticationException();

        $token = Auth::user()->token();
        $token->delete();
    }

    /**
     * @return Authenticatable
     * @throws AuthenticationException
     */
    public function getAuthUser(): Authenticatable
    {
        if (!Auth::check())
            throw new AuthenticationException();

        return Auth::user();
    }
}
