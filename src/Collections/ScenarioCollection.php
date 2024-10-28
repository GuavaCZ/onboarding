<?php

namespace Guava\Onboarding\Collections;

use Guava\Onboarding\Filament\Scenario;
use Illuminate\Support\Collection;

class ScenarioCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function whereRequiresCompletion(): static
    {
        return $this->filter(fn (Scenario $scenario) => $scenario->isCompletionRequired());
    }

    public function whereNotCompleted(): static
    {
        return $this->filter(fn (Scenario $scenario) => ! $scenario->isCompleted());
    }
}
