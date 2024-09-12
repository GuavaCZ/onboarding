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

    public function setStep(Step $step): void
    {
        $this->step = $step;
    }

    public function getStep(): Step
    {
        return $this->step;
    }

    public function findStep(string $id) {
        return data_get(filament('guava-onboarding')->getCachedStepsOnly(), $id);
    }
}
