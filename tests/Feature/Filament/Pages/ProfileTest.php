<?php

use App\Filament\Pages\App\Profile;
use App\Models\User;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

it('can render the profile page', function () {
    livewire(Profile::class)
        ->assertSuccessful();
});

it('can update profile', function () {
    $updatedUser = User::factory()->make();

    livewire(Profile::class)
        ->fillForm([
            'name' => $updatedUser->name,
            'email' => $updatedUser->email,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(User::class, [
        'name' => $updatedUser->name,
        'email' => $updatedUser->email,
    ]);
});

it('can update password and authenticate', function () {
    $user = auth()->user();

    livewire(Profile::class)
        ->fillForm([
            'password' => 'new-password',
            'passwordConfirmation' => 'new-password',
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    auth()->logout();
    $this->assertGuest();

    $this->assertTrue(auth()->attempt([
        'email' => $user->email,
        'password' => 'new-password',
    ]));
});

it('can validate password confirmation', function () {
    livewire(Profile::class)
        ->fillForm([
            'password' => 'password',
            'passwordConfirmation' => 'different-password',
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasFormErrors(['password' => ['same']]);
});

it('can validate required', function ($column) {
    livewire(Profile::class)
        ->fillForm([$column => null])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['name', 'email']);

it('can validate email', function () {
    livewire(Profile::class)
        ->fillForm([
            'email' => 'invalid-email-format',
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasFormErrors(['email' => ['email']]);
});

it('can validate unique email', function () {
    $user = User::factory()->create();

    livewire(Profile::class)
        ->fillForm([
            'email' => $user->email,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasFormErrors(['email' => ['unique']]);
});

it('can validate max length', function (string $column) {
    livewire(Profile::class)
        ->fillForm([$column => Str::random(256)])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasFormErrors([$column => ['max:255']]);
})->with(['name', 'email']);
