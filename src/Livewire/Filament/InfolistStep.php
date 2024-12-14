<?php

namespace Guava\Onboarding\Livewire\Filament;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Guava\Onboarding\Concerns\Filament\IsInfolistStep;
use Guava\Onboarding\Livewire\Step;

abstract class InfolistStep extends Step implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;
    use IsInfolistStep;
}
