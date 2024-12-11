<?php

namespace Guava\Onboarding\Filament;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

abstract class Journey extends Component
{
    /** @var class-string<Step> */
    public string $current;

    public function mount(?string $step = null)
    {
        //        $step ??= Arr::first($this->steps())::key();
        $step ??= array_key_first($this->steps());
        $this->setStep($step);
    }

    /**
     * @return class-string<Step>[]
     */
    abstract public function steps(): array;

    public function setStep(string $step)
    {
        $this->current = data_get($this->steps(), $step);

        $this->js('window.history.pushState({}, "", "' . route($this->routeName(), ['step' => $step]) . '")');
    }

    #[On('journey::previous-step')]
    public function previousStep() {
        if ($next = collect($this->steps())
            ->before(fn (string $step) => $step === $this->current)
        ) {
            $this->setStep($next::key());
        }
    }

    #[On('journey::next-step')]
    public function nextStep()
    {
        //        $this->validate();

//                $this->store();

        if ($next = collect($this->steps())
            ->after(fn (string $step) => $step === $this->current)
        ) {
            $this->setStep($next::key());
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

    public function render()
    {
        return view('guava-onboarding::livewire.journey');
    }

    abstract public function routeName(): string;
}
