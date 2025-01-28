<?php

namespace Guava\Onboarding\ConcernsOld;

trait HasScenarios
{
    protected array $scenarios = [];

    protected array $journeys = [];

    public function scenarios(array $scenarios): static
    {
        $this->scenarios = $scenarios;

        return $this;
    }

    public function journeys(array $journeys): static
    {
        $this->journeys = $journeys;

        return $this;
    }

    public function getScenarios()
    {
        return $this->evaluate($this->scenarios);
    }

    public function getJourneys()
    {
        return $this->evaluate($this->journeys);
    }
}
