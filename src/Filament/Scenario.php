<?php

namespace Guava\Onboarding\Filament;

use Filament\Support\Concerns\Configurable;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasLabel;
use Guava\Onboarding\Concerns\HasPrompt;
use Guava\Onboarding\Concerns\HasSteps;
use Guava\Onboarding\Facades\Onboarding;
use Livewire\Wireable;

class Scenario implements Wireable
{
    use Configurable;
    use EvaluatesClosures;
    use HasLabel;
    use HasSteps;
    use HasPrompt;


    public function __construct(
        protected ?string $id = null
    )
    {
    }

    public static function getRoutePath(): string
    {
        return '';
    }

    public static function getRouteName(): string
    {
        throw new Exception('Please implement getRouteName() method.');
    }

    public static function make(string $id = null): static
    {
        return app(static::class, [
            'id' => $id,
        ])
            ->configure()
        ;
    }

    public function resolveRouteBinding(mixed $value)
    {
        if ($value instanceof Scenario) {
            return $value;
        }

        $scenario = filament()->getPlugin('guava-onboarding')->findScenario($value);

        if (! $scenario) {
            return null;
        }
        $scenario->id = $value;
        Onboarding::setScenario($scenario);

        return $scenario;
    }

    public function toLivewire()
    {
        return get_object_vars($this);
    }

    public static function fromLivewire($value)
    {
        return app(static::class, ...$value);
    }

    public function id(string $id) {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getNextStep(): ?Step
    {
        $steps = array_values($this->getSteps()); // get array values
        $key = array_search(Onboarding::getStep(), $steps);

        if ($key !== false) {
            return data_get($steps, $key + 1);
        }

        return null;
    }
}
