<?php

namespace Guava\Onboarding\Filament;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

/**
 * @property string $journey
 */
abstract class Step extends Component
{

    public function mount() {
        $this->retrieve();
    }

    abstract public static function key(): string;

    public function nextStep()
    {
        $this->store();
        $this->dispatch('journey::next-step');
    }
    public function previousStep()
    {
        $this->store();
        $this->dispatch('journey::previous-step');
    }

    public function store()
    {
        Session::put($this->sessionKey(), $this->all());
    }

    public function retrieve() {
        $data = Session::get($this->sessionKey(), []);
        $this->fill($data);

        return $data;
    }

    public function retrieveAll() {
        $data = Session::get(static::$journey, []);

        return $data;
    }

    public function clear() {
        Session::forget($this->sessionKey());
    }

    public function clearAll() {
        Session::forget(static::$journey);
    }

    public function sessionKey(): string
    {
        return static::$journey . '.' . static::key();
    }
}
