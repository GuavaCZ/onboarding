<?php

namespace Guava\Onboarding;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Collections\ScenarioCollection;
use Guava\Onboarding\ConcernsOld\HasPrefix;
use Guava\Onboarding\ConcernsOld\HasScenarios;
use Guava\Onboarding\Filament\Scenario;
use Livewire\Livewire;
use Livewire\Mechanisms\ComponentRegistry;

class OnboardingPlugin implements Plugin
{
    use EvaluatesClosures;
    use HasPrefix;
    use HasScenarios;
    use Panel\Concerns\HasComponents;

    protected ScenarioCollection $cachedScenarios;

    protected array $cachedSteps = [];

    protected array $cachedStepsOnly = [];

    public function getId(): string
    {
        return 'guava-onboarding';
    }

    public function register(Panel $panel): void
    {
        app()->scoped('onboarding', function (): Onboarding {
            return new Onboarding;
        });

        //        return;

        $this->cacheScenarios();
        $this->registerRoutes($panel);

    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }

    public static function make(): static
    {
        return new static;
    }

    private function cacheScenarios(): ScenarioCollection
    {
        $this->cachedScenarios = new ScenarioCollection;

        foreach ($this->getScenarios() as $scenario) {
            $this->cachedScenarios->put($scenario->getId(), $scenario);
        }

        return $this->cachedScenarios;
    }

    public function getCachedScenarios(): ScenarioCollection
    {
        return $this->cachedScenarios;
    }

    public function getCachedScenario(string $id): ?Scenario
    {
        return data_get($this->cachedScenarios, $id);
    }

    private function registerRoutes(Panel $panel): void
    {
        $this->getCachedScenarios()->each(
            fn (Scenario $scenario) => $scenario->registerRoutes($panel)
        );

        $panel->pages($this->getJourneys());

        foreach ($this->getJourneys() as $journey) {
            $instance = new $journey;
            foreach ($instance->steps() as $step) {
//                $name = app(Compone::class)->getName($step);
                Livewire::component($step, $step);
            }
        }
    }
}
