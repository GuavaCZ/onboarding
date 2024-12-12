<?php

namespace Guava\Onboarding\Support;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class SessionMetaSynth extends Synth
{
    public static $key = 'session-meta';

    public static function match($target)
    {
        return $target instanceof SessionMeta;
    }

    public function dehydrate($target)
    {
        return [[
            'group' => $target->group,
            'key' => $target->key,
        ], []];
    }

    public function hydrate($value)
    {
        return new SessionMeta(
            $value['group'],
            $value['key'],
        );
    }
}
