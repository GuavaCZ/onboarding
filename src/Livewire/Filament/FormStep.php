<?php

namespace Guava\Onboarding\Livewire\Filament;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Guava\Onboarding\Concerns\Filament\IsFormStep;
use Guava\Onboarding\Livewire\Step;

abstract class FormStep extends Step implements HasForms
{
    use InteractsWithForms;
    use IsFormStep;
}
