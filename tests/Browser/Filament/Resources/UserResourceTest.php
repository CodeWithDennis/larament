<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('can create a new user', function () {
    $user = User::factory()->make();

    visit('/admin')
        ->click('Users')
        ->click('New user')
        ->fill('form.name', $user->name)
        ->fill('form.email', $user->email)
        ->fill('form.password', 'password')
        ->press('.fi-ac-btn-action[type=submit]')
        ->assertSee('Created');

    assertDatabaseHas('users', [
        'name' => $user->name,
        'email' => $user->email,
    ]);
});

it('can edit an existing user', function () {
    $newRecord = User::factory()->make();

    visit('/admin')
        ->click('Users')
        ->click('Edit')
        ->fill('form.name', $newRecord->name)
        ->click('.fi-ac-btn-action[type=submit]')
        ->assertSee('Saved');

    assertDatabaseHas('users', [
        'name' => $newRecord->name,
    ]);
});

it('can delete an existing user', function () {
    visit('/admin')
        ->click('Users')
        ->click('Edit')
        ->click('Delete')
        ->click('.fi-modal-window button[type=submit]')
        ->assertSee('Deleted');

    assertDatabaseMissing('users', [
        'id' => auth()->user()->id,
    ]);
});
