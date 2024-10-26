<?php

namespace App\Filament\Resources\TeamResource\Pages;

use App\Filament\Resources\TeamResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTeam extends CreateRecord
{
    public function getHeading(): string
    {
        return 'Создать команду';
    }

    protected static string $resource = TeamResource::class;
}
