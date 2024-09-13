<?php

namespace Guava\Onboarding;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Widgets\Widget;
use Guava\Onboarding\Concerns\HasPrefix;
use Guava\Onboarding\Concerns\HasScenarios;
use Guava\Onboarding\Filament\Scenario;

class OnboardingPlugin implements Plugin
{
    use Panel\Concerns\HasComponents;
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
        $this->registerRoutes($panel);
        //        $this->cacheSteps();
        //        $this->registerRoutes($panel);

    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }

    public static function make(): static
    {
        return new static;
    }

    private function cacheScenarios()
    {
        foreach ($this->getScenarios() as $scenario) {
            $this->cachedScenarios[$scenario->getId()] = $scenario;
        }
    }

    public function getCachedScenarios(): array
    {
        return $this->cachedScenarios;
    }

    public function getCachedScenario(string $id): ?Scenario
    {
        return data_get($this->cachedScenarios,$id);
    }

    private function registerRoutes(Panel $panel)
    {
        foreach ($this->getCachedScenarios() as $scenario) {
            $scenario->registerRoutes($panel);
        }
    }

//    public function discoverScenarios(string $in, string $for): static
//    {
//        if ($this->hasCachedComponents()) {
//            return $this;
//        }
//
//        $this->widgetDirectories[] = $in;
//        $this->widgetNamespaces[] = $for;
//
//        $this->discoverComponents(
//            Widget::class,
//            $this->widgets,
//            directory: $in,
//            namespace: $for,
//        );
//
//        return $this;
//    }
}
