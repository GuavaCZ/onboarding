<?php

namespace Guava\Onboarding\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Guava\Onboarding\Onboarding
 */
class Onboarding extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'onboarding';
    }
}
