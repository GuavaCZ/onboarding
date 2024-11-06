<?php

namespace Guava\Onboarding\Filament;

use Filament\Widgets\Widget;
use Filament\Widgets\WidgetConfiguration;

class ScenarioWidget extends Widget
{
    protected static string $view = 'guava-onboarding::widgets.scenario-widget';

    public Scenario $scenario;

    public static function make(array $properties = []): WidgetConfiguration
    {
        $scenario = data_get($properties, 'scenario');

        if (is_string($scenario)) {
            $scenario = filament('guava-onboarding')->getCachedScenarios()->get($scenario);
        }

        if (! $scenario instanceof Scenario) {
            throw new \InvalidArgumentException('The scenario must be an instance of ' . Scenario::class . ' or a scenario ID.');
        }

        data_set($properties, 'scenario', $scenario);

        return parent::make($properties);
    }
}
