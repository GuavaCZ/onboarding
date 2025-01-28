<?php

namespace Guava\Onboarding\Collections;

use Filament\Forms\Components\Wizard\Step;
use Illuminate\Support\Collection;

class StepCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }

    public function whereNotCompleted(): static
    {
        return $this->filter(fn (Step $step) => ! $step::isCompleted());
    }
}
