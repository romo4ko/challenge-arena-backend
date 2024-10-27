<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\User\Request\UserUpdateDTO;
use App\DTO\Api\User\Response\UserAchievementPersonalDTO;
use App\DTO\Api\User\Response\UserAchievementTeamsDTO;
use App\DTO\Api\User\Response\UserChallengeDTO;
use App\DTO\Api\User\Response\UserTeamDTO;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function achievement(Team $team, User $user): array
    {
        $achievementPersonal = $user->achievements()->get();
        $achievementTeams = $team->achievements()->get();

        $personal = UserAchievementPersonalDTO::collect($achievementPersonal)->toArray();
        $teams = UserAchievementTeamsDTO::collect($achievementTeams)->toArray();

       return array_merge($personal, $teams);
    }

    public function update(User $user, UserUpdateDTO $userUpdateDTO): array|JsonResponse
    {
        if ($user->id === auth()->id()) {
            $savedImage = null;

            if ($userUpdateDTO->image) {
                $savedImage = $userUpdateDTO->image->store(options: ['disk' => 'public']);
            }

            $user->update([
                'image' => Storage::disk('public')->url($savedImage),
                'name' => $userUpdateDTO->name,
                'surname' => $userUpdateDTO->surname,
                'patronymic' => $userUpdateDTO->patronymic,
                'email' => $userUpdateDTO->email,
                'about' => $userUpdateDTO->about,
            ]);

            return $user->toArray();
        }

        return response()->json(['message' => 'just meme'], 403);
    }

    public function team(User $user): array
    {
        $team = $user->teams()->get();

        return UserTeamDTO::collect($team)->toArray();
    }

    public function challenge(User $user): array
    {
        $challenges = $user->challenges()->orderBy('end_date', 'desc')->get();

        return UserChallengeDTO::collect($challenges)->toArray();
    }
}
