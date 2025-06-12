<?php

namespace Guava\Onboarding\Concerns\Filament;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;

trait IsSchemaStep
{
    use HasActions;

    public function render()
    {
        return view('guava-onboarding::step');
    }
}
