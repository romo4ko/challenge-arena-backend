<?php

namespace App\Http\Controllers\Api;

use App\DTO\Api\Challenge\Request\ChallengeFilterDTO;
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
}
