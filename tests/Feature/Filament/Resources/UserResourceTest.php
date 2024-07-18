<?php

use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Str;

use function Pest\Livewire\livewire;

it('can render the index page', function () {
    livewire(ListUsers::class)
        ->assertSuccessful();
});

it('can render the create page', function () {
    livewire(CreateUser::class)
        ->assertSuccessful();
});

it('can render the edit page', function () {
    $record = User::factory()->create();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->assertSuccessful();
});

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
})->with(['name', 'email', 'created_at', 'updated_at']);

it('can search column', function (string $column) {
    $records = User::factory(5)->create();

    $value = $records->first()->{$column};

    livewire(ListUsers::class)
        ->searchTable($value)
        ->assertCanSeeTableRecords($records->where($column, $value))
        ->assertCanNotSeeTableRecords($records->where($column, '!=', $value));
})->with(['name', 'email']);

it('can create a record', function () {
    $record = User::factory()->make();

    livewire(CreateUser::class)
        ->fillForm([
            'name' => $record->name,
            'email' => $record->email,
            'password' => $record->password,
            'passwordConfirmation' => $record->password,
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(User::class, [
        'name' => $record->name,
        'email' => $record->email,
    ]);
});

it('can update a record', function () {
    $record = User::factory()->create();
    $newRecord = User::factory()->make();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->fillForm([
            'name' => $newRecord->name,
            'email' => $newRecord->email,
        ])
        ->assertActionExists('save')
        ->call('save')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(User::class, [
        'name' => $newRecord->name,
        'email' => $newRecord->email,
    ]);
});

it('can delete a record', function () {
    $record = User::factory()->create();

    livewire(EditUser::class, ['record' => $record->getRouteKey()])
        ->assertActionExists('delete')
        ->callAction(DeleteAction::class);

    $this->assertModelMissing($record);
});

it('can bulk delete records', function () {
    $records = User::factory(5)->create();

    livewire(ListUsers::class)
        ->assertTableBulkActionExists('delete')
        ->callTableBulkAction(DeleteBulkAction::class, $records);

    foreach ($records as $record) {
        $this->assertModelMissing($record);
    }
});

it('can validate required', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm([$column => null])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['required']]);
})->with(['name', 'email']);

it('can validate unique', function (string $column) {
    $record = User::factory()->create();

    livewire(CreateUser::class)
        ->fillForm(['email' => $record->email])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['unique']]);
})->with(['email']);

it('can validate email', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm(['email' => Str::random()])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['email']]);
})->with(['email']);

it('can validate max length', function (string $column) {
    livewire(CreateUser::class)
        ->fillForm([$column => Str::random(256)])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors([$column => ['max:255']]);
})->with(['name', 'email']);

it('can validate password confirmation', function () {
    $record = User::factory()->make();

    livewire(CreateUser::class)
        ->fillForm([
            'password' => $record->password,
            'passwordConfirmation' => Str::random(),
        ])
        ->assertActionExists('create')
        ->call('create')
        ->assertHasFormErrors(['password' => ['same']]);
});
