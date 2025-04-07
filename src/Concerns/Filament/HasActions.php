<?php

namespace Guava\Onboarding\Concerns\Filament;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\IconPosition;
use Illuminate\Support\Arr;

trait HasActions
{
    /**
     * Get the actions for the component.
     *
     * @return array<Action|ActionGroup>
     */
    public function actions(): array
    {
        return [
            $this->getPreviousStepAction(),
            $this->getNextStepAction(),
            $this->getSubmitAction(),
        ];
    }

    protected function getActions(): array
    {
        return Arr::whereNotNull($this->actions());
    }

    /**
     * Default previous step action.
     */
    public function getPreviousStepAction(): ?Action
    {
        return Action::make('previous-step')
            ->label(__('guava-onboarding::actions.previous-step'))
            ->action('previousStep')
            ->icon('heroicon-o-arrow-small-left')
            ->color('gray')
            ->hidden(fn () => ! collect($this->steps)->before(fn ($step) => $step === $this->current))
        ;
    }

    /**
     * Default next step action.
     */
    public function getNextStepAction(): ?Action
    {
        return Action::make('next-step')
            ->label(__('guava-onboarding::actions.next-step'))
            ->action('nextStep')
            ->icon('heroicon-o-arrow-small-right')
            ->iconPosition(IconPosition::After)
            ->color('gray')
            ->hidden(fn () => ! collect($this->steps)->after(fn ($step) => $step === $this->current))
        ;
    }

    /**
     * Default submit action.
     */
    public function getSubmitAction(): ?Action
    {
        return Action::make('submit')
            ->label(__('guava-onboarding::actions.submit'))
            ->action('submit')
            ->extraAttributes([
                'class' => 'ml-auto',
            ])
            ->hidden(fn () => collect($this->steps)->last() !== $this->current)
        ;
    }
}
