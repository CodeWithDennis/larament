<?php

namespace App\Filament\Actions\GlobalSearch;

use Filament\GlobalSearch\Actions\Action;

class TestAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'test';
    }

    protected function setUp(): void
    {
        parent::setUp();

        // TODO: Add your setup logic here
    }
}
