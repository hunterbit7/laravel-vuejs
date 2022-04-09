<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Services\Authentication\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{

    /**
     * @var AuthService
     */
    protected $authService;

    /**
     * Constructor.
     *
     * @param AuthService $authService
     */
    public function __construct (AuthService $authService)
    {
        $this->middleware('auth:api', ['only' => ['logout', 'authUser']]);
        $this->authService = $authService;
    }

    /**
     * Login.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login (LoginRequest $request): JsonResponse
    {
        $token = $this->authService->login($request->validated());
        return $this->showResult($token, 'User logged in successfully.');
    }

    /**
     * Logout.
     *
     * @return JsonResponse
     */
    public function logout (): JsonResponse
    {
        $this->authService->logout();
        return $this->showMessage('User logged out successfully.');
    }

    /**
     * Retrieve authenticated user.
     *
     * @return JsonResponse
     */
    public function authUser(): JsonResponse
    {
        $user = $this->authService->getAuthUser();
        return $this->showResult(new UserResource($user), 'Authenticated user retrieved successfully.');
    }
}
