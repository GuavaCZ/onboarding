<?php

namespace Guava\Onboarding;

use Guava\Onboarding\Filament\Scenario;
use Guava\Onboarding\Filament\Step;

class Onboarding
{
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
}
