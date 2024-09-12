<?php

use Guava\Onboarding\Onboarding;

if (! function_exists('onboarding')) {
    function onboarding(?string $plugin = null): Onboarding
    {
        $onboarding = app('onboarding');

        return $onboarding;
    }
}
