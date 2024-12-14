<?php

namespace Guava\Onboarding\Livewire\Filament;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Guava\Onboarding\Concerns\Filament\IsContentStep;
use Guava\Onboarding\Livewire\Step;
use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class ContentStep extends Step
{
    use IsContentStep;
}
