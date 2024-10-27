<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Team\Request\TeamUpdateDTO;
use App\DTO\Api\Team\Response\TeamMembersDTO;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class TeamService
{
    public function update(Team|null $team, TeamUpdateDTO $teamUpdateDTO): array|JsonResponse
    {
        if(!$team) {
            return [];
        }

        if ($team->captain_id === auth()->id()) {
            $savedImage = null;

            if ($teamUpdateDTO->image) {
                $savedImage = $teamUpdateDTO->image->store(options: ['disk' => 'public']);
            }

            $team->update([
                'image' =>  Storage::disk('public')->url($savedImage),
                'name' => $teamUpdateDTO->name,
                'description' => $teamUpdateDTO->description,
            ]);

            return $team->toArray();
        }

        return response()->json(['message' => 'you are dont captain'], 403);
    }

    public function members(Team|null $team): array
    {
        if ($team) {
            $members = $team->users()->get();

            $membersTeam = $members->map(function (User $user) use ($team) {
                return TeamMembersDTO::from($user, $team);
            });

            return $membersTeam->toArray();
        }

        return [];
    }
}
