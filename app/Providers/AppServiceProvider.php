<?php

namespace App\Providers;

use Filament\Forms\Components\Field;
use Filament\Support\Components\Component;
use Filament\Support\Concerns\Configurable;
use Illuminate\Support\ServiceProvider;
use Filament\Tables\Filters\BaseFilter;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\Column;
use Filament\Infolists\Components\Entry;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        foreach ([Field::class, BaseFilter::class, Placeholder::class, Column::class, Entry::class] as $component) {
            /* @var Configurable $component */
            $component::configureUsing(function (Component $translatable): void {
                $translatable->translateLabel();
            });
        }
    }
}
