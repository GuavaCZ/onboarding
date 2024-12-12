<?php

namespace Guava\Onboarding\ConcernsOld;

use Closure;

trait HasLabel
{
    protected null | string | Closure $label = null;

    public function label(string | Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->evaluate($this->label) ?? str(class_basename(static::class))
            ->chopEnd(['Scenario', 'Step'])
            ->headline()
        ;
    }
}
