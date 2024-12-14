<?php

namespace Guava\Onboarding\Concerns\Filament;

trait IsInfolistStep {

    use HasActions;

    public function render()
    {
        return view('guava-onboarding::steps.infolist');
    }
}
