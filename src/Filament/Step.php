<?php

namespace Guava\Onboarding\Filament;

use Guava\Onboarding\Filament\Concerns\TracksProgress;
use Guava\Onboarding\Support\SessionMeta;
use Guava\Onboarding\Support\StepInfo;
use Livewire\Attributes\Session;
use Livewire\Component;
use Livewire\Livewire;

use function Livewire\trigger;

abstract class Step extends Component implements \Guava\Onboarding\Contracts\Step
{
    use TracksProgress;

    /** @var class-string<Step> */
    public ?string $current = null;

    public array $steps = [];

//    #[\Livewire\Attributes\Session(key: '{session.group}.meta.currentStep')]
//    public ?string $stepProgress = null;

    public SessionMeta $session;

    #[Session(key: '{session.group}.state')]
    public array $state = [];

    #[Session(key: '{session.group}.state.{session.key}')]
    public array $data = [];

    public ?StepInfo $stepInfo = null;

//    private \Guava\Onboarding\Contracts\Journey $journeyComponent;

    public function __construct()
    {
        $this->session = $this->session();
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

    public function goToStep(string $step): void
    {
        $this->dispatch('journey::go-to-step', $step)->to($this->getJourney());
    }

    public function clear(): void
    {
        $this->data = [];
        $this->state = [];
        $this->session->clear();
        $this->dispatch('journey::clear');
    }

    abstract public function session(): SessionMeta;

    public function state(?string $key = null): ?array
    {
        if ($key) {
            return data_get($this->state, $key);
        }

        return collect($this->state)
            ->reduce(function (array $carry, array $item) {
                return array_merge($carry, $item);
            }, [])
        ;
    }

    abstract public function getStepInfo(): StepInfo;

//    protected function getJourneyComponent(string $step, array $params = []): \Guava\Onboarding\Contracts\Journey
//    {
//        //        $parent = app('livewire')->current();
//        if ($class = $step) {
//            $component = app('livewire')->new($class);
//            trigger('mount', $component, $params, null, null);
//
//            return $component;
//        }
//
//        throw new \Exception('No current step set');
//    }

    public static function getLayout(): string
    {
        return static::$layout ?? 'guava-onboarding::layouts.blank';
    }

    /**
     * @return class-string<\Guava\Onboarding\Contracts\Journey>
     */
    public function getJourney(): string
    {
        if (!isset(static::$journey)) {
            throw new \Exception('No journey set');
        }

        return static::$journey;
    }
}
