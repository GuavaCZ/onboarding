<?php

namespace Guava\Onboarding\ConcernsOld;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;

trait HasFooterActions {

    /**
     * @var array<Action | ActionGroup>
     */
    protected array $cachedFooterActions = [];

    public function bootedHasFooterActions(): void
    {
        $this->cacheFooterActions();
    }
}
