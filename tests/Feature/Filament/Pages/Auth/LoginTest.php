<?php

use App\Models\User;
use Filament\Facades\Filament;

test('an unauthenticated user can access the login page', function () {
    $this->get(Filament::getLoginUrl())
        ->assertOk();
});

test('an unauthenticated user can not access the admin panel', function () {
    $this->get('admin')
        ->assertRedirect(Filament::getLoginUrl());
});

test('an authenticated user can access the admin panel', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $this->actingAs($user)
        ->get('admin')
        ->assertOk();
});

test('an authenticated user can logout', function () {
    $user = User::factory()->create([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);

    $this->actingAs($user)
        ->get('admin')
        ->assertOk();

    $this->post('admin/logout')
        ->assertRedirect(Filament::getLoginUrl());
});
