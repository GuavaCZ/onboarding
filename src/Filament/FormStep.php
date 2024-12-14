<?php

namespace Guava\Onboarding\Filament;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class FormStep extends Step implements HasForms
{
    use InteractsWithForms;

    public function render()
    {
        return view('guava-onboarding::steps.form');
    }
}
