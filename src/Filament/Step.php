<?php

namespace Guava\Onboarding\Filament;

use Guava\Onboarding\Support\SessionMeta;
use Livewire\Attributes\Session;
use Livewire\Component;

abstract class Step extends Component
{
    public SessionMeta $session;

    #[Session(key: '{session.group}.state')]
    public array $state = [];

    #[Session(key: '{session.group}.state.{session.key}')]
    public array $data = [];

    public function __construct()
    {
        $this->session = $this->session();
    }

    public function nextStep(): void
    {
        $this->dispatch('journey::next-step');
    }

    public function previousStep(): void
    {
        $this->dispatch('journey::previous-step');
    }

    public function setStep(string $step): void
    {
        $this->dispatch('journey::set-step', $step);
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
}
