<?php

declare(strict_types=1);

arch('All files in the casts directory extend `CastsAttributes`')
    ->expect('App\Casts')
    ->toExtend('Illuminate\Contracts\Database\Eloquent\CastsAttributes');

arch('All files in the casts directory have suffix `Cast`')
    ->expect('App\Casts')
    ->toHaveSuffix('Cast');

arch('All files in the observers directory have suffix `Observer`')
    ->expect('App\Observers')
    ->toHaveSuffix('Observer');

arch('All files in the policies directory have suffix `Policy`')
    ->expect('App\Policies')
    ->toHaveSuffix('Policy');

arch('All files in the services directory have suffix `Service`')
    ->expect('App\Services')
    ->toHaveSuffix('Service');

arch('ensures `env()` is only used in config files')
    ->expect('env')
    ->not->toBeUsed()
    ->ignoring('config');

arch('No file in the app directory uses `die`, `dd`, or `dump`.')
    ->expect('App')
    ->not->toUse(['die', 'dd', 'dump', 'ray']);
