<?php

namespace App\Filament\Resources\ChallengeResource\Pages;

use App\Filament\Resources\ChallengeResource;
use App\Http\Controllers\Api\TelegramController;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChallenge extends EditRecord
{
    public function getHeading(): string
    {
        return 'Управление челленджем';
    }

    protected static string $resource = ChallengeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('Отправить уведомления')
                ->action('sendNotification')
                ->color('success'),
        ];
    }

    public function sendNotification(TelegramController $controller): void
    {
        $record = $this->form->getRecord();

        $url = env('FRONTEND_URL') . "/challenges/{$record->id}";
        $message = "Создан новый челлендж: {$record->name}! \nСкорее присоединяйся по ссылке {$url}";

        $controller->sendMessageForAll($message);
    }
}
