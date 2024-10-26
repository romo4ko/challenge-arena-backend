<?php

namespace App\DTO\Api\User\Response;

use App\Models\Challenge;
use Spatie\LaravelData\Data;

class UserChallengeDTO extends Data
{
    public function __construct(
        public int $id,
        public ?string $image,
        public string $name,
        public string $description,
        public string $endDate
    ){
    }

    public static function fromModal(Challenge $challenge): self
    {
        return new self(
            $challenge->id,
            $challenge->image,
            $challenge->name,
            $challenge->description,
            $challenge->end_date
        );
    }
}
