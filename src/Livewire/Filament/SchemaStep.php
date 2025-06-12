<?php

namespace Guava\Onboarding\Livewire\Filament;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Guava\Onboarding\Concerns\Filament\IsFormStep;
use Guava\Onboarding\Concerns\Filament\IsSchemaStep;
use Guava\Onboarding\Livewire\Step;

abstract class SchemaStep extends Step implements HasSchemas, HasActions
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use IsSchemaStep;
}
