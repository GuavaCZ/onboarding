<?php

namespace Guava\Onboarding\Support;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class StepInfoSynth extends Synth
{
    public static $key = 'step-info';

    public static function match($target)
    {
        return $target instanceof StepInfo;
    }

    public function dehydrate($target)
    {
        return [[
            'label' => $target->label,
            'description' => $target->description,
            'optional' => $target->optional,
        ], []];
    }

    public function hydrate($value)
    {
        return new StepInfo(
            $value['label'],
            $value['description'],
            $value['optional'],
        );
    }
}
