<?php

declare(strict_types=1);

namespace App\DTO\Api\Challenge\Response;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class ChallengeShowDTO extends Data
{
    public function __construct(
        public Challenge $challenge,
        public Collection $members,
    ) {
    }

    public static function fromModel(Challenge $challenge): self
    {
        return new self(
            $challenge,
            $challenge->users()->get(),
        );
    }
}
