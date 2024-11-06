<?php

namespace Guava\Onboarding\Concerns;

trait HasScenarios
{
    protected array $scenarios = [];

    public function scenarios(array $scenarios): static
    {
        $this->scenarios = $scenarios;

        return $this;
    }

    public function getScenarios()
    {
        return $this->evaluate($this->scenarios);
    }
}
