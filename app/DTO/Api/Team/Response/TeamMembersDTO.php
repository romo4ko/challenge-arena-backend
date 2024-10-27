<?php

declare(strict_types=1);

namespace App\DTO\Api\Team\Response;

use App\Models\Team;
use App\Models\User;
use Spatie\LaravelData\Data;

class TeamMembersDTO extends Data
{
    public function __construct(
        public User $user,
        public bool $isCaptain,
    ){
    }

    public static function fromMultiple(User $user, Team $team): self
    {
        return new self(
            $user,
            $team->captain_id === $user->id,
        );
    }
}
