<?php

namespace Guava\Onboarding\Filament\Concerns\Resources;

use Guava\Onboarding\Filament\Scenario;
use Illuminate\Database\Eloquent\Model;

trait RequiresScenario
{
    abstract public static function getScenario(): Scenario;

    public static function can(string $action, ?Model $record = null): bool
    {
        $authorize = parent::can($action, $record);

        if (! $authorize) {
            return false;
        }

        if ($scenario = static::getScenario()) {
            if ($action === 'viewAny') {
                return true;
            }

            if (! $scenario->isCompleted()) {
                return false;
            }
        }

        return $authorize;
    }
}
