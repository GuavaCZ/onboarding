<?php

namespace Guava\Onboarding\Livewire\Filament;

use Guava\Onboarding\Concerns\Filament\IsContentStep;
use Guava\Onboarding\Livewire\Step;

abstract class ContentStep extends Step
{
    use IsContentStep;
}
