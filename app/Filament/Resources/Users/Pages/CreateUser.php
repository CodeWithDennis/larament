<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Override;

final class CreateUser extends CreateRecord
{
    #[Override]
    protected static string $resource = UserResource::class;
}
