<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\Models\Team;
use App\Models\User;
use App\Services\Api\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function teamIsCaptain(int $id): array
    {
        $teams = User::query()->findOrFail($id);

        return $this->userService->teamIsCaptain($teams);
    }

    public function show(int $id): array
    {
        $user = User::query()->findOrFail($id);

        return $this->userService->show($user);
    }

    public function update(int $id, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        $user = User::query()->findOrFail($id);

        return $this->userService->update($user, $userUpdateDTO);
    }

    public function team(int $id): array
    {
        $teams = User::query()->findOrFail($id);

        return $this->userService->team($teams);
    }

    public function challenge(int $id): array
    {
        $challenges = User::query()->findOrFail($id);

        return $this->userService->challenge($challenges);
    }

    public function achievement(int $id): array
    {
        $achievementsTeam = Team::query()->find($id);
        $achievementPersonal = User::query()->find($id);

        if(!$achievementPersonal || !$achievementsTeam)
        {
            return [];
        }

        return $this->userService->achievement($achievementsTeam, $achievementPersonal);
    }
}
