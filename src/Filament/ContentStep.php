<?php

namespace Guava\Onboarding\Filament;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class ContentStep extends Step
{
    public function render()
    {
        return view('guava-onboarding::steps.content');
    }
}
