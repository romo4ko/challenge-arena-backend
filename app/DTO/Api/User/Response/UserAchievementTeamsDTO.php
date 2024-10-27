<?php

namespace App\DTO\Api\User\Response;

use App\Models\Achievement;
use App\Models\Enums\Achievement\TypeAchievement;
use Spatie\LaravelData\Data;

class UserAchievementTeamsDTO extends Data
{
    public function __construct(
        public string $id,
        public ?string $image,
        public string $name,
        public string $description,
        public TypeAchievement $type
    ){
    }

    public static function fromModal(Achievement $achievement): self
    {
        return new self(
            $achievement->id,
            $achievement->image,
            $achievement->name,
            $achievement->description,
            TypeAchievement::Team,
        );
    }
}
