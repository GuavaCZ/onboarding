<?php

namespace Guava\Onboarding;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasPrefix;
use Guava\Onboarding\Concerns\HasScenarios;
use Illuminate\Support\Facades\Route;

class OnboardingPlugin implements Plugin
{
    use EvaluatesClosures;
    use HasPrefix;
    use HasScenarios;

    protected array $cachedScenarios = [];

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
        $this->cacheSteps();
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

    public function findScenario(string $scenario)
    {
        return data_get($this->getScenarios(), $scenario);
    }

    public function findStep(string $scenario, string $step)
    {
        $scenario = data_get($this->getScenarios(), $scenario);

        return data_get($scenario->getSteps(), $step);
    }

    protected function cacheScenarios(): void
    {
        foreach ($this->getScenarios() as $scenario) {
            data_set($this->cachedScenarios, $scenario->getId(), $scenario);
        }
    }

    protected function cacheSteps(): void
    {
        foreach ($this->getScenarios() as $scenario) {
            foreach ($scenario->getSteps() as $step) {
                $step->scenario($scenario);
                data_set($this->cachedSteps, "{$scenario->getId()}.{$step->getId()}", $step);
                data_set($this->cachedStepsOnly, "{$step->getId()}", $step);
            }
        }
    }

    protected function registerRoutes(Panel $panel)
    {
        foreach ($this->getCachedScenarios() as $id => $scenario) {
            match ($panel->hasTenancy()) {
                true => $panel->authenticatedTenantRoutes(
                    fn() => Route::get("/$this->prefix/$id/{step}", $scenario->getPrompt())
                        ->name('onboarding.prompt')
                ),
                false => $panel->authenticatedRoutes(
                    fn() => Route::get("/$this->prefix/$id/{step}", $scenario->getPrompt())
                        ->name('onboarding.prompt')
                )
            };
        }
    }

    public function getCachedScenarios() {
        return $this->cachedScenarios;
    }

    public function getCachedSteps() {
        return $this->cachedSteps;
    }
    public function getCachedStepsOnly() {
        return $this->cachedStepsOnly;
    }
}
