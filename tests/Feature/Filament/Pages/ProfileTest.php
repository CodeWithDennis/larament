<?php

use App\Filament\Pages\App\Profile;

use function Pest\Livewire\livewire;

it('can render the profile page', function () {
    livewire(Profile::class)
        ->assertSuccessful();
});
