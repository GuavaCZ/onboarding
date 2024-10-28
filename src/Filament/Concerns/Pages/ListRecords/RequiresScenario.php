<?php

namespace Guava\Onboarding\Filament\Concerns\Pages\ListRecords;

use Guava\Onboarding\Filament\Scenario;

trait RequiresScenario
{

    public function getView(): string
    {
        if ($this->getScenario()->isCompleted()) {
            return parent::getView();
        }

        return 'guava-onboarding::filament.scenario-incomplete.list-records';
    }

    public function getScenario(): Scenario
    {
        return static::getResource()::getScenario();
    }

}
