<?php

use Filament\Facades\Filament;

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

test('an authenticated user can access the admin panel', function () {
    $this->get('admin')
        ->assertOk();
});

test('an authenticated user can logout', function () {
    $this->get('admin')
        ->assertOk();

    $this->post('admin/logout')
        ->assertRedirect(Filament::getLoginUrl());
});
