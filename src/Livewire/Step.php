<?php

namespace Guava\Onboarding\Livewire;

use Guava\Onboarding\Concerns\IsStep;
use Guava\Onboarding\Contracts\Step as StepContract;
use Livewire\Component;

abstract class Step extends Component implements StepContract
{
    use IsStep;
}
