<?php

namespace App\Filament\Resources\ChallengeResource\Pages;

use App\Filament\Resources\ChallengeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChallenge extends CreateRecord
{
    public function getHeading(): string
    {
        return 'Создать челлендж';
    }

    protected static string $resource = ChallengeResource::class;
}
