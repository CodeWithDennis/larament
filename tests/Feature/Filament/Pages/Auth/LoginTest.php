<?php

use App\Filament\Pages\Auth\Login;
use Filament\Facades\Filament;

use function Pest\Livewire\livewire;

test('an unauthenticated user can access the login page', function () {
    auth()->logout();

    $this->get(Filament::getLoginUrl())
        ->assertOk();
});

test('an unauthenticated user can not access the admin panel', function () {
    auth()->logout();

    $this->get('admin')
        ->assertRedirect(Filament::getLoginUrl());
});

test('an unauthenticated user can login', function () {
    auth()->logout();

    livewire(Login::class)
        ->fillForm([
            'email' => config('app.default_user.email'),
            'password' => config('app.default_user.password'),
        ])
        ->assertActionExists('authenticate')
        ->call('authenticate')
        ->assertHasNoFormErrors();
});

test('an authenticated user can access the admin panel', function () {
    $this->get('admin')
        ->assertOk();
});

test('an authenticated user can logout', function () {
    $this->assertAuthenticated();

    $this->post(Filament::getLogoutUrl())
        ->assertRedirect(Filament::getLoginUrl());
});
