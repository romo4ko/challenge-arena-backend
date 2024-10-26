<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\Models\User;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function show(int $id): array
    {
        return User::query()->findOrFail($id)?->toArray();
    }

    public function update(int $id, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        $user = User::query()->findOrFail($id);

        return $this->userService->update($user, $userUpdateDTO);

    }

    public function team()
    {
    }

    public function challenge()
    {
    }

    public function achievement()
    {
    }
}
