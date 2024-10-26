<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Auth\Request\UserAuthDTO;
use App\DTO\Api\Auth\Request\UserRegisterDTO;
use App\DTO\Api\Auth\Response\UserAuthShowDTO;
use App\DTO\Api\Auth\Response\UserRegisterShowDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    public function auth(User $user, UserAuthDTO $userAuthDTO): array|JsonResponse
    {
        if(Hash::check($userAuthDTO->password, $user->password)) {
            $token = $user->createToken('token')->plainTextToken;

            return UserAuthShowDTO::from($user, $token)->toArray();
        }

        return response()->json(['message' => 'bad creds'], 403);
    }

    public function register(UserRegisterDTO $userRegisterDTO): array
    {
        $user = User::query()->create($userRegisterDTO->toArray());
        $token = $user->createToken('token')->plainTextToken;

        return UserRegisterShowDTO::from($user, $token)->toArray();
    }
}
