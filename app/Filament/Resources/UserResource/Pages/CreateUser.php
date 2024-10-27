<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    public function getHeading(): string
    {
        return 'Создать пользователя';
    }

    protected static string $resource = UserResource::class;
}
