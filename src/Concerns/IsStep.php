<?php

namespace Guava\Onboarding\Concerns;

use Guava\Onboarding\Contracts\Journey;
use Guava\Onboarding\Filament\Concerns\TracksProgress;
use Guava\Onboarding\Livewire\Step;
use Guava\Onboarding\Support\SessionStore;

/**
 * @property class-string<Journey> $journey
 */
trait IsStep
{
    use InteractsWithStore;
    use TracksProgress;

    /** @var class-string<Step> */
    public string $currentStep;

    /** @var class-string<Step> */
    public string $reachedStep;

    public array $steps = [];

    public function mount(): void
    {
        $this->preMount();
        $this->doMount();
        $this->postMount();
    }

    protected function preMount(): void
    {
        //        $this->currentStep = $this->store()->meta()->get('current-step');
        //        $this->reachedStep = $this->session->meta()->get('reached-step');
    }

    protected function doMount(): void {}

    protected function postMount(): void
    {
        //        $this->initialize(request()->get('step'));
    }

    protected function makeStore(): SessionStore
    {
        return (new SessionStore)
            ->key(static::getSessionKey())
        ;
    }

    public function getLayout(): string
    {
        return static::$layout ?? 'guava-onboarding::layouts.blank';
    }

    public function getLayoutData(): array
    {
        return [];
    }

    public function nextStep(): void
    {
        $this->dispatch('journey::next-step')->to($this->getJourney());
    }

    public function previousStep(): void
    {
        $this->dispatch('journey::previous-step')->to($this->getJourney());
    }

    public function setStep(string $step): void
    {
        $this->dispatch('journey::set-step', $step)->to($this->getJourney());
    }

    //
    public function goToStep(string $step): void
    {
        $this->dispatch('journey::go-to-step', $step)->to($this->getJourney());
    }

    /**
     * @return class-string<Journey>
     */
    public function getJourney(): string
    {
        if (! isset(static::$journey)) {
            throw new \Exception('No journey set');
        }

        return static::$journey;
    }

    abstract public static function getSessionKey(): string;
}
