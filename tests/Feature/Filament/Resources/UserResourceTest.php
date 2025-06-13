<?php

declare(strict_types=1);

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Testing\TestAction;
use Illuminate\Support\Str;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

beforeEach(function () {
    /* The TestCase setup generates a user before each test, so we need to clear the table to make sure we have a clean slate. */
    User::truncate();
});

it('can render the index page', function () {
    livewire(ListUsers::class)
        ->assertSuccessful();
});

it('can render the create page', function () {
    livewire(CreateUser::class)
        ->assertSuccessful();
});
//
it('can render the edit page', function () {
    $record = User::factory()->create();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});
//
it('has column', function (string $column) {
    livewire(ListUsers::class)
        ->assertTableColumnExists($column);
})->with(['name', 'email', 'created_at', 'updated_at']);

it('can render column', function (string $column) {
    livewire(ListUsers::class)
        ->assertCanRenderTableColumn($column);
})->with(['name', 'email', 'created_at', 'updated_at']);

it('can sort column', function (string $column) {
    $records = User::factory(5)->create();

    livewire(ListUsers::class)
        ->sortTable($column)
        ->assertCanSeeTableRecords($records->sortBy($column), inOrder: true)
        ->sortTable($column, 'desc')
        ->assertCanSeeTableRecords($records->sortByDesc($column), inOrder: true);
})->with(['name']);

it('can search column', function (string $column) {
    $records = User::factory(5)->create();

    $value = $records->first()->{$column};

    livewire(ListUsers::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['name']);

it('can create a user', function () {
    $record = User::factory()->make();

    livewire(CreateUser::class)
        ->fillForm([
            'name' => $record->name,
            'email' => $record->email,
            'password' => $record->password,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(User::class, [
        'name' => $record->name,
        'email' => $record->email,
    ]);
});

it('can update a user', function () {
    $record = User::factory()->create();
    $newRecord = User::factory()->make();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'name' => $newRecord->name,
            'email' => $newRecord->email,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(User::class, [
        'name' => $newRecord->name,
        'email' => $newRecord->email,
    ]);
});

it('can delete a user', function () {
    $record = User::factory()->create();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($record);
});

it('can bulk delete users', function () {
    $users = User::factory()->count(5)->create();

    livewire(ListUsers::class)
        ->assertCanSeeTableRecords($users)
        ->selectTableRecords($users)
        ->callAction(TestAction::make(DeleteBulkAction::class)->table()->bulk())
        ->assertNotified()
        ->assertCanNotSeeTableRecords($users);

    $users->each(fn (User $user) => assertDatabaseMissing($user));
});

it('can validate required', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm([$column => null])
        ->call('create')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['name', 'email']);

it('can validate unique', function (string $column) {
    $record = User::factory()->create();

    livewire(CreateUser::class)
        ->fillForm(['email' => $record->email])
        ->call('create')
        ->assertHasFormErrors([$column => ['unique']]);
})->with(['email']);

it('can validate email', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm(['email' => Str::random()])
        ->call('create')
        ->assertHasFormErrors([$column => ['email']]);
})->with(['email']);

it('can validate max length', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm([$column => Str::random(256)])
        ->call('create')
        ->assertHasFormErrors([$column => ['max:255']]);
})->with(['name', 'email']);
