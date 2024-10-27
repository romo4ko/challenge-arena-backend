<?php

namespace App\Http\Controllers\Api;

use App\DTO\Api\Challenge\Request\ChallengeFilterDTO;
use App\Models\Challenge;
use App\Models\Team;
use App\Models\User;
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
        $challenge = Challenge::query()->find($id);

        return $this->challengeService->show($challenge);
    }

    public function joinPersonal(int $id, int $userId): array
    {
        $user = User::query()->find($userId);
        $challenge = Challenge::query()->find($id);

        if ($user && $user->telegram_id && $challenge) {
            $tg = new TelegramController();
            $tg->sendMessage($user->telegram_id, 'Уведомление о челлендже - ' . $challenge->name);

            return ['success' => true];
        }

        return [];
    }

    public function joinTeam(int $id, int $teamId): array
    {
        $challenge = Challenge::query()->find($id);

        $team = Team::query()->find($teamId);
        $user = User::query()->find($team?->captain_id);

        if ($team && $user && $user->telegram_id && $challenge) {
            $tg = new TelegramController();

            $tg->sendMessage($user->telegram_id, 'Отправили вашей команде вызов на челлендж - ' . $challenge->name);
        }

        return [];
    }
}
