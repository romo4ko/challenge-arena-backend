<?php

namespace App\DTO\Api\Challenge\Request;

use App\Models\Enums\Challenge\ChallengeType;
use Spatie\LaravelData\Data;

class ChallengeFilterDTO extends Data
{
    public function __construct(
        public ?ChallengeType $challengeType,
        public ?string $startDate,
        public ?string $endDate,
    ){
    }
}
