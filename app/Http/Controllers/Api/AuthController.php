<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Auth\Request\UserAuthDTO;
use App\DTO\Api\Auth\Request\UserRegisterDTO;
use App\Models\User;
use App\Services\Api\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
      protected AuthService $authService
    ) {
    }

    public function auth(UserAuthDTO $userAuthDTO): array|JsonResponse
    {
        $user = User::query()->where('email', $userAuthDTO->email)->firstOrFail();

        return $this->authService->auth($user, $userAuthDTO);
    }

    public function register(UserRegisterDTO $userRegisterDTO): array
    {
        return $this->authService->register($userRegisterDTO);
    }
}
