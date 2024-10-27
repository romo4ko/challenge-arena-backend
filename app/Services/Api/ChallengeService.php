<?php

namespace App\Services\Api;

use App\DTO\Api\Challenge\Request\ChallengeFilterDTO;
use App\DTO\Api\Challenge\Response\ChallengeShowDTO;
use App\Models\Challenge;
use Illuminate\Database\Eloquent\Builder;

class ChallengeService
{
    public function index(ChallengeFilterDTO $challengeFilterDTO): array
    {
        $games = Challenge::query()
            ->when($challengeFilterDTO->challengeType, function (Builder $query) use ($challengeFilterDTO) {
                $query->where('type', '=', $challengeFilterDTO->challengeType->value);
            })
            ->when($challengeFilterDTO->startDate, function (Builder $query) use ($challengeFilterDTO) {
                $query->where('start_date', '>=', $challengeFilterDTO->startDate);
            })
            ->when($challengeFilterDTO->endDate, function (Builder $query) use ($challengeFilterDTO) {
                $query->where('end_date', '<=', $challengeFilterDTO->endDate);
            })
            ->orderBy('end_date', 'desc')
            ->get();

        return $games->toArray();
    }

    public function show(Challenge $challenge): array
    {
        return ChallengeShowDTO::from($challenge)->toArray();
    }
}
