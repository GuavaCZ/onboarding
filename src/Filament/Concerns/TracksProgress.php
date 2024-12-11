<?php

namespace Guava\Onboarding\Filament\Concerns;

use Guava\Onboarding\Enums\ProgressState;
use Guava\Onboarding\Support\Progress;
use Livewire\Attributes\On;

trait TracksProgress
{
    public array $progress = [];

    public function bootedTracksProgress()
    {
        if ($this->current) {

        $this->refreshProgress();
        }
    }

    #[On('journey::refresh-progress')]
    public function refreshProgress() {

        $currentFound = false;

        $currentStepName = $this->current;

        $this->progress = collect($this->steps())
            ->map(function (string $stepName) use (&$currentFound, $currentStepName) {
//                $className = app(ComponentRegistry::class)->getClass($stepName);
//
//                $info = (new $className())->stepInfo();

                $status = $currentFound ? ProgressState::Next : ProgressState::Previous;

                if ($stepName === $currentStepName) {
                    $currentFound = true;
                    $status = ProgressState::Current;
//                    $status = 'current';
                }

                return new Progress($stepName, [], $status);
            })
            ->toArray();
    }
}
