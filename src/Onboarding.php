<?php

namespace Guava\Onboarding;

use Closure;
use Guava\Onboarding\Filament\Scenario;
use Guava\Onboarding\Livewire\Step;

class Onboarding
{
    protected static bool $fake = false;

    protected ?Scenario $scenario = null;

    protected ?Step $step = null;

    public function setScenario(Scenario $scenario): void
    {
        $this->scenario = $scenario;
    }

    public function getScenario(): Scenario
    {
        return $this->scenario;
    }

    public static function fake(): Closure
    {
        static::$fake = true;

        return function () {
            static::$fake = false;
        };
    }

    public static function isFake(): bool
    {
        return static::$fake;
    }
}
