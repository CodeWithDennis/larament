<?php

namespace App\Filament\Actions;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class GeneratePasswordAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'generatePassword';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-key')
            ->color('info')
            ->action(function (Set $set) {
                $password = Str::password();

                $set('password', $password);
                $set('passwordConfirmation', $password);

                Notification::make()
                    ->success()
                    ->title(__('Password successfully generated.'))
                    ->send();
            });
    }
}
