<?php

namespace App\Http\Controllers\Api;

use App\DTO\Api\Challenge\Request\ChallengeFilterDTO;
use App\Models\Challenge;
use App\Services\Api\ChallengeService;

class ChallengeController extends Controller
{
    public function __construct(
        protected ChallengeService $challengeService
    ){
    }

    public function index(ChallengeFilterDTO $challengeFilterDTO): array
    {
        return $this->challengeService->index($challengeFilterDTO);
    }

    public function show(int $id): array
    {
        $challenge = Challenge::query()->findOrFail($id);

        return $this->challengeService->show($challenge);
    }

    public function joinPersonal(): array
    {
        return [];
    }

    public function joinTeam(): array
    {
        return [];
    }
}
