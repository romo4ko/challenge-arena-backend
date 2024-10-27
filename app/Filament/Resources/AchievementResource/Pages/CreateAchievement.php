<?php

namespace App\Filament\Resources\AchievementResource\Pages;

use App\Filament\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAchievement extends CreateRecord
{
    public function getHeading(): string
    {
        return 'Создать ачивку';
    }

    protected static string $resource = AchievementResource::class;
}
