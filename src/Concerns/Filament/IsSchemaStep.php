<?php

namespace Guava\Onboarding\Concerns\Filament;

trait IsSchemaStep
{
    use HasActions;

    public function render()
    {
        return view('guava-onboarding::step');
    }
}
