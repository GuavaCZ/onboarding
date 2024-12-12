<?php

namespace Guava\Onboarding\Filament;

use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class FormStep extends Step
{
    public function render()
    {
        return view('guava-onboarding::steps.form');
    }
}
