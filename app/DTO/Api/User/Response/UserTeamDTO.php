<?php

declare(strict_types=1);

namespace App\DTO\Api\User\Response;

use Spatie\LaravelData\Data;

class UserTeamDTO extends Data
{
    public function __construct(
        public int $teamId,
        public ?string $image,
        public string $name,
        public int $countMembers
    ) {
    }

    public static function fromMultiple($team): self
    {
        return new self(
            $team->id,
            $team->image,
            $team->name,
            $team->users->count(),
        );
    }
}
