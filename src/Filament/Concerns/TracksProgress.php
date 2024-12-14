<?php

namespace Guava\Onboarding\Filament\Concerns;

use Guava\Onboarding\Enums\ProgressState;
use Guava\Onboarding\Support\Progress;
use Livewire\Attributes\On;

trait TracksProgress
{
    public array $progress = [];

    #[\Livewire\Attributes\Session(key: '{session.group}.meta.reached-step')]
    public ?string $reachedStep = null;

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

        $this->progress = collect($this->steps)
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

                $info = [];

                $indexAllowed = array_search($this->reachedStep, $this->steps);
                $index = array_search($stepName, $this->steps);
                $allowed = $index <= $indexAllowed;
                $stepKey = (new $stepName)->session->key;
                    $info = [
                        'allowed' => $allowed,
                    ];
//                }

                return new Progress($stepKey, $info, $status);
            })
            ->toArray();
    }
}
