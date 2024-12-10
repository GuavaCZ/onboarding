<?php

namespace Guava\Onboarding\Filament;

use Livewire\Component;

abstract class Step extends Component
{
    abstract public static function key(): string;
}
