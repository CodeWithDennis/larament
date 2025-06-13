<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BasePage;

final class Login extends BasePage
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
