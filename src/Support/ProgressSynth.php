<?php

namespace Guava\Onboarding\Support;

use Guava\Onboarding\Enums\ProgressState;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class ProgressSynth extends Synth
{
    public static $key = 'progress';

    public static function match($target)
    {
        return $target instanceof Progress;
    }

    public function dehydrate($target)
    {
        return [[
            'progressName' => $target->progressName,
            'info' => $target->info,
            'state' => $target->state->value,
        ], []];
    }

    public function hydrate($value)
    {
        return new Progress(
            $value['progressName'],
            $value['info'],
            ProgressState::from($value['state']),
        );
    }
}
