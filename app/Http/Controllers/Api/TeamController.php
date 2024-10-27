<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Api\Team\Request\TeamUpdateDTO;
use App\Models\Team;
use App\Services\Api\TeamService;
use Illuminate\Http\JsonResponse;

class TeamController extends Controller
{
    public function __construct(
        protected TeamService $teamService
    ){
    }

    public function show(int $id): array
    {
        return Team::query()->find($id)?->toArray() ?? [];
    }

    public function update(int $id, TeamUpdateDTO $teamUpdateDTO): array|JsonResponse
    {
        $team = Team::query()->find($id);

        return $this->teamService->update($team, $teamUpdateDTO);
    }

    public function members(int $id): array
    {
        $team = Team::query()->find($id);

        return $this->teamService->members($team);
    }

    public function achievements(int $id): array
    {
        return Team::query()->find($id)?->achievements()->get()->toArray() ?? [];
    }

    public function challenge(int $id): array
    {
        return Team::query()->find($id)?->challenges()->get()->toArray() ?? [];
    }
}
