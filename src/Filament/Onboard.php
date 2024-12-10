<?php

namespace Guava\Onboarding\Filament;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\Alignment;
use Guava\Onboarding\Facades\Onboarding;
use Illuminate\Database\Eloquent\Model;

abstract class Onboard extends Step
{
    use HasRoutes;
    use InteractsWithFormActions;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    public int $order = 0;

    public function mount(): void
    {
        $this->order = $this->scenario->getStepOrder($this);
    }

    public Scenario $scenario;

    protected static string $layout = 'guava-onboarding::layouts.default';

    protected static string $view;

    protected function getLayoutData(): array
    {
        return [
            ...parent::getLayoutData(),
            'hasLogo' => $this->hasLogo(),
            'scenario' => $this->scenario,
            'step' => $this,
            'livewire' => $this,
        ];
    }

    protected function getViewData(): array
    {
        return [
            'hasLogo' => $this->hasLogo(),
            'layout' => $this->getLayout(),
            'step' => $this,
        ];
    }

    public function getTotalSteps(): int
    {
        return $this->scenario->getTotalSteps();
    }

    public function getNextStep()
    {
        return data_get($this->scenario->getSteps(), $this->order + 1);
    }

    public function hasNextStep(): bool
    {
        return $this->order + 1 < $this->getTotalSteps();
    }

    public function getFormActions(): array
    {
        return [
            $this->getNextStepAction(),
            $this->getCompleteScenarioAction(),
        ];
    }

    public function getNextStepAction()
    {
        return Action::make('next')
            ->hidden(! $this->hasNextStep())
            ->url(fn () => $this->scenario->getSteps()->after(static::class)::getUrl([
                'scenario' => $this->scenario,
            ]))
        ;
    }

    public function getCompleteScenarioAction()
    {
        return Action::make('complete')
            ->hidden($this->hasNextStep())
            ->url(\filament()->getCurrentPanel()->getUrl())
        ;
    }

    public static function withTenant(): bool
    {
        return false;
    }

    public static function getUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?Model $tenant = null): string
    {
        $panel ??= Filament::getCurrentPanel()?->getId();

        if (! static::withTenant()) {
            if (blank($panel) || Filament::getPanel($panel)->hasTenancy()) {
                $parameters['tenant'] ??= ($tenant ?? Filament::getTenant());
            }
        }

        $scenario = data_get($parameters, 'scenario');

        if (! $scenario) {
            throw new \InvalidArgumentException('Scenario is required to generate URL');
        }

        //        $parameters['scenario'] = Onboarding::getScenario()->getId();
        //
        //        $scenario = Onboarding::getScenario();
        $routeName = Filament::getPanel($panel)->generateRouteName(
            $scenario->getPrefix() . '.' . $scenario->getId() . '.' .static::getRouteName($panel)
        );

        return route($routeName, $parameters, $isAbsolute);
    }

    public static function isCompleted(): bool
    {
        return true;
    }
}
