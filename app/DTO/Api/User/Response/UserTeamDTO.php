<?php

declare(strict_types=1);

namespace App\DTO\Api\User\Response;

use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Spatie\LaravelData\Data;

class UserTeamDTO extends Data
{
    public function __construct(
        public int $id,
        public ?string $image,
        public string $name,
        public ?int $countMembers
    ) {
    }

    public static function fromModal(Team $team): self
    {
        return new self(
            $team->id,
            $team->image,
            $team->name,
            $team->users->count(),
        );
    }
}
