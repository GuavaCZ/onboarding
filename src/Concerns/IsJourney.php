<?php

namespace Guava\Onboarding\Concerns;

use Filament\Support\Exceptions\Halt;
use Guava\Onboarding\Filament\Concerns\TracksProgress;
use Guava\Onboarding\Filament\Step;
use Guava\Onboarding\Support\SessionMeta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

trait IsJourney
{
    use TracksProgress;

//    protected static string $view = 'guava-onboarding::livewire.journey';

    /** @var class-string<Step> */
    public ?string $current = null;

    #[\Livewire\Attributes\Session(key: '{session.group}.meta.currentStep')]
    public ?string $stepProgress = null;

    public SessionMeta $session;

    public function __construct()
    {
        $this->session = $this->session();
        dump(Session::all());
    }

    public function mount(?string $step = null)
    {
        $step ??= array_key_first($this->steps());

        // Specific step requested
        if ($step) {
            $stepClass = Arr::first(
                $this->steps(),
                function (string $stepClass) use ($step) {
                    /** @var Step $instance */
                    $instance = new $stepClass;

                    return $instance->session->key === $step;
                }
            );
            if ($this->authorizeStep($stepClass)) {
                $this->setStep($stepClass);
            } else {
                if (! $this->stepProgress) {
                    $this->stepProgress = Arr::first($this->steps());
                }
                $this->setStep($this->stepProgress);
            }
            // TODO: Check if it's allowed, otherwise go to the last possible step (stored in session)
        }
        // No step requested
        else {
            // TODO: Check if there's a stored step
            // TODO: -> If yes, go to that step
            // TODO: -> If no, go to the first step
            if ($this->stepProgress) {
                $this->setStep($this->stepProgress);
            } else {
                $this->setStep(Arr::first($this->steps()));
            }
        }

        //        if ($this->authorizeStep($stepClass)) {
        //            $this->setStep($stepClass);
        //        } else {
        //            $this->setStep($this->stepProgress);
        //        }
    }

    /**
     * @return class-string<Step>[]
     */
    abstract public function steps(): array;

    public function setStep(string $step)
    {
        $indexAllowed = array_search($this->stepProgress, $this->steps());
        $index = array_search($step, $this->steps());

        $this->current = $step;
        if ($index > $indexAllowed) {
            $this->stepProgress = $step;
        }
        // TODO: Check here if the step CAN be set (either it's before the current or if current is null, only if its the first)
        // TODO: If yes, store it (JourneyState::save())

        /** @var Step $instance */
        $instance = new $step;

        $this->js('window.history.pushState({}, "", "' . $this->url([
            'step' => $instance->session->key,
        ]) . '")');
    }

    #[On('journey::previous-step')]
    public function previousStep()
    {
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
                //                JourneyMeta::save($this, $next);
                $this->setStep($next);
            }

            $this->refreshProgress();
        } catch (Halt $exception) {
            return;
        }
    }

    #[On('journey::clear')]
    public function clear()
    {
        $this->stepProgress = null;
        $this->setStep(Arr::first($this->steps()));
        $this->refreshProgress();
    }

    abstract public function routeName(): string;

    public function urlArguments(array $arguments = []): array
    {
        return $arguments;
    }

    public function url(array $arguments = []): string
    {
        return route($this->routeName(), $this->urlArguments($arguments));
    }

    public function authorizeStep(string $step): bool
    {
        $indexAllowed = array_search($this->stepProgress, $this->steps());
        $index = array_search($step, $this->steps());

        return $index <= $indexAllowed;
    }

    abstract public function session(): SessionMeta;

    public function getStepData(): array
    {
        return [];
    }

//    public function render(): View
//    {
//        return view($this->getView())
//            ->layout($this->getLayout())
//        ;
//    }
}
