<?php

namespace App\Services\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;

interface AuthService
{
    public function login (array $credentials): mixed;

    public function logout (): void;

    public function getAuthUser (): Authenticatable;
}
