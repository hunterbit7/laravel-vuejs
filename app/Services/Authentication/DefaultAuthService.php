<?php

namespace App\Services\Authentication;

use App\Repositories\Authentication\AuthRepository;
use Illuminate\Contracts\Auth\Authenticatable;

class DefaultAuthService implements AuthService
{
    /**
     * @var AuthRepository
     */
    protected $authRepository;

    /**
     * Constructor.
     *
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(array $credentials): mixed
    {
        return $this->authRepository->login($credentials);
    }

    public function logout(): void
    {
        $this->authRepository->logout();
    }

    public function getAuthUser(): Authenticatable
    {
        return $this->authRepository->getAuthUser();
    }

}
