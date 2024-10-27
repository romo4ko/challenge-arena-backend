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

    public function show(int $id): array
    {
        return User::query()->findOrFail($id)?->toArray();
    }

    public function update(int $id, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        $user = User::query()->findOrFail($id);

        return $this->userService->update($user, $userUpdateDTO);
    }

    public function team(int $id): array
    {
        $teams = User::query()->findOrFail($id)?->teams()->get();

        return $this->userService->team($teams);
    }

    public function challenge(int $id): array
    {
        $challenges = User::query()->findOrFail($id)?->challenges()->orderBy('end_date', 'desc')->get();

        return $this->userService->challenge($challenges);
    }

    public function achievement(int $id): array
    {
        $achievementsTeam = Team::query()->findOrFail($id)?->achievements()->get();
        $achievementPersonal = User::query()->findOrFail($id)?->achievements()->get();

        return $this->userService->achievement($achievementsTeam, $achievementPersonal);
    }
}
