<?php

namespace Guava\Onboarding\Filament;

use Filament\Panel;
use Filament\Support\Concerns\Configurable;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasId;
use Guava\Onboarding\Concerns\HasLabel;
use Guava\Onboarding\Facades\Onboarding;
use Livewire\Livewire;
use Livewire\Wireable;

class Scenario implements Wireable
{
    use Configurable;
    use EvaluatesClosures;
    use HasId;
    use HasLabel;

    protected array $steps = [];

    protected string $prefix = 'onboarding';

    public function prefix(string $prefix) {
        $this->prefix = $prefix;
        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function steps(array $steps) {
        $this->steps = $steps;

        return $this;
    }

    public function getSteps(): array
    {
        return $this->steps;
    }

    public static function make() {
        return app(static::class);
    }

    public function registerRoutes(Panel $panel) {
        foreach ($this->getSteps() as $step) {
            dump($step);
            $panel->authenticatedTenantRoutes(function() use ($step) {
                \Route::get($this->prefix . '/{scenario}/' . $step::getRoutePath(), $step)
                    ->name($this->prefix . '.' . $this->getId() . '.' . $step::getRouteName());
            });

            Livewire::component($this->getId() . '-' . class_basename($step), $step);
        }
    }

    public function resolveRouteBinding($value, $field = null) {
        if ($value instanceof Scenario) {
            return $value;
        }

        $scenario = filament('guava-onboarding')->getCachedScenario($value);
        Onboarding::setScenario($scenario);

        return $scenario;
    }

    public function toLivewire()
    {
        return ['id' => $this->getId()];
    }

    public static function fromLivewire($value)
    {
        return filament('guava-onboarding')->getCachedScenario(
            data_get($value, 'id')
        );
    }

    public function getStepOrder(Onboard $step) {
        return array_search($step::class, $this->getSteps());
    }

    public function getTotalSteps() {
        return count($this->getSteps());
    }
}
