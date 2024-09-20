<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BasePage;

class Login extends BasePage
{
    public function mount(): void
    {
        parent::mount();

        if (app()->isLocal()) {
            $this->form->fill([
                'email' => config('app.default_user.email'),
                'password' => config('app.default_user.password'),
                'remember' => true,
            ]);
        }
    }
}
