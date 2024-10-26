<?php

namespace App\Filament\Resources\AchievementResource\Pages;

use App\Filament\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAchievement extends EditRecord
{
    public function getHeading(): string
    {
        return 'Изменить ачивку';
    }

    protected static string $resource = AchievementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
