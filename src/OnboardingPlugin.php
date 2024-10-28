<?php

namespace Guava\Onboarding;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Collections\ScenarioCollection;
use Guava\Onboarding\Concerns\HasPrefix;
use Guava\Onboarding\Concerns\HasScenarios;
use Guava\Onboarding\Filament\Scenario;

class OnboardingPlugin implements Plugin
{
    use Panel\Concerns\HasComponents;
    use EvaluatesClosures;
    use HasPrefix;
    use HasScenarios;

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
        $this->cachedScenarios = new ScenarioCollection();

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
        return data_get($this->cachedScenarios,$id);
    }

    private function registerRoutes(Panel $panel): void
    {
        $this->getCachedScenarios()->each(
            fn(Scenario $scenario) => $scenario->registerRoutes($panel)
        );
    }

}
