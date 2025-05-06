<?php

namespace Guava\Onboarding\Concerns;

use Filament\Support\Exceptions\Halt;
use Guava\Onboarding\Livewire\Step;
use Guava\Onboarding\Support\SessionMeta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Livewire\Attributes\On;

trait IsJourney
{
    /** @var class-string<Step> */
    public string $currentStep;

    public string $currentStepName;

    /** @var class-string<Step> */
    #[\Livewire\Attributes\Session(key: '{session.group}.meta.reached-step')]
    public ?string $reachedStep = null;

    public SessionMeta $session;

    public function __construct()
    {
        $this->session = $this->session();

    }

    public function initialize(?string $step): void
    {
        $this->reachedStep ??= Arr::first($this->steps());

        // Specific step requested
        if ($step) {
            $stepClass = $this->classByName($step);

            // If authorized, go to the step
            if ($this->authorizeStep($stepClass)) {
                $this->setStep($stepClass);

                return;
            }
        }

        // No step requested or unauthorized step requested -> go to the max reached step
        $this->setStep($this->reachedStep);
    }

    public function mount(?string $step = null): void
    {
        $this->initialize($step);
    }

    public function refresh()
    {
        //        $stepComponent = $this->getStepComponent($this->current, $this->getStepData());
        //        $this->stepInfo = $stepComponent->getStepInfo();
        //        $this->dispatch('journey::refresh-progress');
    }

    /**
     * @return class-string<Step>[]
     */
    abstract public function steps(): array;

    protected function setStep(string $step)
    {
        $indexAllowed = array_search($this->reachedStep, $this->steps());
        $index = array_search($step, $this->steps());

        $this->currentStep = $step;
        $this->currentStepName = (new $step)->session->key;
        if ($index > $indexAllowed) {
            $this->reachedStep = $step;
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
    public function previousStep(): void
    {
        if ($previous = collect($this->steps())
            ->before(fn (string $step) => $step === $this->currentStep)
        ) {
            $this->goToStep($previous);
        }
    }

    #[On('journey::next-step')]
    public function nextStep(): void
    {
        if ($next = collect($this->steps())
            ->after(fn (string $step) => $step === $this->currentStep)
        ) {
            $this->goToStep($next);
        }
    }

    #[On('journey::go-to-step')]
    public function goToStep(string $step): void
    {
        if (! class_exists($step)) {
            $step = $this->classByName($step);
        }

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

            $this->setStep($step);
            $this->refresh();
        } catch (Halt $exception) {
            return;
        }
    }

    #[On('journey::clear')]
    public function clear()
    {
        $this->reachedStep = null;
        $this->setStep(Arr::first($this->steps()));
        $this->refresh();
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
        $indexAllowed = array_search($this->reachedStep, $this->steps());
        $index = array_search($step, $this->steps());

        return $index <= $indexAllowed;
    }

    abstract public function session(): SessionMeta;

    public function getStepData(): array
    {
        return [
            'step' => $this->currentStepName,
        ];
    }

    /**
     * @return class-string<Step>
     *
     * @throws \Exception
     */
    private function classByName(string $step): string
    {
        if ($step = Arr::first(
            $this->steps(),
            function (string $stepClass) use ($step) {
                /** @var Step $instance */
                $instance = new $stepClass;

                return $instance->session->key === $step;
            }
        )) {
            return $step;
        }

        throw new \Exception('Step not found in the journey');
    }

    public function getJourneyInfo()
    {
        return [];
    }

    public function route()
    {
        return \Illuminate\Support\Facades\Route::get(
            //            $this->ro
        )
            ->name($this->routeName())
        ;
    }

    public function render(): View
    {
        return view('guava-onboarding::components.journey');
    }

    public static function requiresCompletion(): bool
    {
        return false;
    }

    public static function completed(): bool
    {
        return false;
    }
}
