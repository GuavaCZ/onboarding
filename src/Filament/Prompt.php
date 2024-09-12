<?php

namespace Guava\Onboarding\Filament;

use Filament\Facades\Filament;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\Alignment;
use Illuminate\Database\Eloquent\Model;

class Prompt extends SimplePage
{
    use HasRoutes;
    use InteractsWithFormActions;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected static string $layout = 'guava-onboarding::layouts.default';

    protected static string $view = 'guava-onboarding::prompt';

    public Scenario $scenario;

    public Step $step;

    public function mount() {
        $this->scenario = $this->step->getScenario();
//        dd($this->step->getOrder());
    }

    protected function getLayoutData(): array
    {
        return [
            ...parent::getLayoutData(),
            'scenario' => $this->scenario,
            'step' => $this->step,
        ];
    }

    protected function getViewData(): array
    {
        return [
//            ...parent::getViewData(),
            'scenario' => $this->scenario,
            'step' => $this->step,
        ];
    }

    public function getFormActions(): array
    {
        return $this->step->getFormActions();
    }


    public static function withTenant(): bool
    {
        return false;
    }


    public static function getRouteName(): string
    {
        return 'onboarding.prompt';
    }

    public static function getUrl(array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?Model $tenant = null): string
    {
        if (! static::withTenant()) {
            if (blank($panel) || Filament::getPanel($panel)->hasTenancy()) {
                $parameters['tenant'] ??= ($tenant ?? Filament::getTenant());
            }
        }

        $routeName = Filament::getPanel($panel)->generateRouteName(static::getRouteName());

        return route($routeName, $parameters, $isAbsolute);
    }
}
