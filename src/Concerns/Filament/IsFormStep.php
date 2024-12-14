<?php

namespace Guava\Onboarding\Concerns\Filament;

trait IsFormStep {
    use HasActions;

    public function render()
    {
        return view('guava-onboarding::steps.form');
    }
}
