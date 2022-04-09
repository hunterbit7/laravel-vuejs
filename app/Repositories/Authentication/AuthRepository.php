<?php

namespace App\Repositories\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;

interface AuthRepository
{
    public function login (array $credentials): mixed;

    public function logout (): void;

    public function getAuthUser (): Authenticatable;
}
