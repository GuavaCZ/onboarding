<?php

namespace Guava\Onboarding\Filament;

use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class InfolistStep extends Step
{
    public function render()
    {
        return view('guava-onboarding::steps.infolist');
    }
}
