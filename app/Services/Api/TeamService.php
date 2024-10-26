<?php

declare(strict_types=1);

namespace App\Services\Api;

use App\DTO\Api\Team\Request\TeamUpdateDTO;
use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class TeamService
{
    public function update(Team $team, TeamUpdateDTO $teamUpdateDTO): array|JsonResponse
    {
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
}
