<?php

namespace Guava\Onboarding\Filament\Concerns;

use Guava\Onboarding\Enums\ProgressState;
use Guava\Onboarding\Support\Progress;
use Livewire\Attributes\On;

trait TracksProgress
{
    public array $progress = [];

    public function mountTracksProgress(): void
    {
        $this->refreshProgress();
    }

    #[On('journey::refresh-progress')]
    public function refreshProgress(): void
    {
        $currentFound = false;


        $this->progress = collect($this->steps)
            ->map(function (string $step) use (&$currentFound) {
                //                $className = app(ComponentRegistry::class)->getClass($stepName);
                //
                //                $info = (new $className())->stepInfo();

                $status = $currentFound ? ProgressState::Next : ProgressState::Previous;

                if ($step === $this->currentStep) {
                    $currentFound = true;
                    $status = ProgressState::Current;
                    //                    $status = 'current';
                }

                $info = [];

                $indexAllowed = array_search($this->reachedStep, $this->steps);
                $index = array_search($step, $this->steps);
                $allowed = $index <= $indexAllowed;
                //                $stepKey = (new $stepName)->session->key;
                $stepKey = $step::getSessionKey();
                $info = [
                    'allowed' => $allowed,
                ];
                //                }

                return new Progress($stepKey, $info, $status);
            })
            ->toArray()
        ;
    }
}
