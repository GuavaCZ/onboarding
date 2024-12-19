<?php

namespace Guava\Onboarding\Support;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class JourneyMetaSynth extends Synth
{
    public static $key = 'journey-state';

    public static function match($target)
    {
        return $target instanceof JourneyMeta;
    }

    public function dehydrate($target)
    {
        return [[
            'currentStep' => $target->currentStep,
        ], []];
    }

    public function hydrate($value)
    {
        return new JourneyMeta(
            $value['currentStep'],
        );
    }
}
