<?php

namespace Guava\Onboarding\Filament;

use Filament\Pages\SimplePage;
use Filament\Support\Exceptions\Halt;
use Filament\Support\Facades\FilamentView;
use Guava\Onboarding\Filament\Concerns\TracksProgress;
use Guava\Onboarding\Support\JourneyMeta;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class Journey extends SimplePage
{
    use TracksProgress;

    /** @var class-string<Step> */
    public ?string $current = null;

    public JourneyMeta $meta;

    public function mount(?string $step = null)
    {
        // Load Journey State
        $this->meta = JourneyMeta::load($this);

        $step ??= array_key_first($this->steps());
        $stepClass = Arr::first($this->steps(), fn (string $stepClass) => $stepClass::key() === $step) ?? Arr::first($this->steps());

        if ($this->authorizeStep($stepClass)) {
            $this->setStep($stepClass);
        } else {
            $this->setStep($this->meta->currentStep);
        }
    }

    /**
     * @return class-string<Step>[]
     */
    abstract public function steps(): array;

    public function setStep(string $step)
    {
        // TODO: Check here if the step CAN be set (either it's before the current or if current is null, only if its the first)
        // TODO: If yes, store it (JourneyState::save())
        $this->current = $step;

        $this->js('window.history.pushState({}, "", "' . $this->url([
            'step' => $step::key(),
            ]) . '")');
    }

    #[On('journey::previous-step')]
    public function previousStep() {
        if ($next = collect($this->steps())
            ->before(fn (string $step) => $step === $this->current)
        ) {
            $this->setStep($next);
        }

        $this->refreshProgress();
    }

    #[On('journey::next-step')]
    public function nextStep()
    {
//        $this->authorizeAccess();

        try {
            //        $this->validate();
            $this->callHook('beforeValidate');
//            $data = $this->validation();
            $this->callHook('afterValidate');

//                $this->store();
            $this->callHook('beforeRemember');
//            $this->remember();
            $this->callHook('afterRemember');

            if ($next = collect($this->steps())
                ->after(fn (string $step) => $step === $this->current)
            ) {
                JourneyMeta::save($this, $next);
                $this->setStep($next);
            }

            $this->refreshProgress();
        } catch (Halt $exception) {
            return;
        }
    }

    public function store()
    {

        Session::put($this->key(), $this->all());
    }

    public function key()
    {
        return static::class;
    }

//    public function render()
//    {
//        return view('guava-onboarding::livewire.journey');
//    }

protected static string $view = 'guava-onboarding::livewire.journey';

    abstract public function routeName(): string;

    public function urlArguments(array $arguments = []): array{
        return $arguments;
    }

    public function url(array $arguments = []): string{
        return route($this->routeName(), $this->urlArguments($arguments));
    }

    public function isStepBeforeCurrent(string $step): bool
    {
        $found = false;
        foreach ($this->steps() as $s) {
            if ($s === $this->current) {
                $found = true;
            }
        }
    }

    public function authorizeStep(string $step): bool {
        $indexCurrent = array_search($this->meta->currentStep, $this->steps());
        $index = array_search($step, $this->steps());

        return $index <= $indexCurrent;
    }
}
