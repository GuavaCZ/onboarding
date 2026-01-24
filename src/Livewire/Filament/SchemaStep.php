<?php

namespace Guava\Onboarding\Livewire\Filament;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Guava\Onboarding\Concerns\Filament\IsSchemaStep;
use Guava\Onboarding\Livewire\Step;

abstract class SchemaStep extends Step implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use IsSchemaStep;
}
