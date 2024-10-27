<?php

namespace App\Models\Enums\Challenge;

enum ChallengeType: string
{
    case PERSONAL = 'personal';
    case TEAM = 'team';

    public static function values(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }
}
