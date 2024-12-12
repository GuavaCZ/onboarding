<?php

namespace Guava\Onboarding\ConcernsOld;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use InvalidArgumentException;

trait InteractsWithFooterActions {

    /**
     * @var array<Action | ActionGroup>
     */
    protected array $cachedFooterActions = [];

    public function bootedInteractsWithFooterActions(): void
    {
        $this->cacheFooterActions();
    }

    protected function cacheFooterActions(): void
    {
        /** @var array<string, Action | ActionGroup> */
        $actions = Action::configureUsing(
            Closure::fromCallable([$this, 'configureAction']),
            fn (): array => $this->getFooterActions(),
        );

        foreach ($actions as $action) {
            if ($action instanceof ActionGroup) {
                $action->livewire($this);

                /** @var array<string, Action> $flatActions */
                $flatActions = $action->getFlatActions();

                $this->mergeCachedActions($flatActions);
                $this->cachedFormActions[] = $action;

                continue;
            }

            if (! $action instanceof Action) {
                throw new InvalidArgumentException('Form actions must be an instance of ' . Action::class . ', or ' . ActionGroup::class . '.');
            }

            $this->cacheAction($action);
            $this->cachedFooterActions[] = $action;
        }
    }

    /**
     * @return array<Action | ActionGroup>
     */
    public function getCachedFooterActions(): array
    {
        return $this->cachedFooterActions;
    }

    /**
     * @return array<Action | ActionGroup>
     */
    public function getFooterActions(): array
    {
        return [];
    }

    protected function hasFullWidthFooterActions(): bool
    {
        return false;
    }
}
