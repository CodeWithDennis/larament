<?php

arch('No debugging statements are left in our code.')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();
