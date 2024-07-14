<?php

namespace App\Filament\Pages\App;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Auth\EditProfile;
use Illuminate\Support\Str;

class Profile extends EditProfile
{
    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make()
                ->inlineLabel(false)
                ->schema([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent()
                        ->suffixAction(
                            Action::make('generatePassword')
                                ->icon('heroicon-o-arrow-path')
                                ->color('info')
                                ->action(function (Set $set) {
                                    $password = Str::password();

                                    $set('password', $password);
                                    $set('passwordConfirmation', $password);
                                }),
                        ),
                    $this->getPasswordConfirmationFormComponent(),
                ]),
        ]);
    }
}
