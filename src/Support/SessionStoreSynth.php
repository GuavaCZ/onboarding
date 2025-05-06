<?php

namespace Guava\Onboarding\Support;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class SessionStoreSynth extends Synth
{
    public static $key = 'session-store';

    public static function match($target): bool
    {
        return $target instanceof SessionStore;
    }

    public function dehydrate($target): array
    {
        return [[
            'id' => $target->id,
            'key' => $target->key,
        ], []];
    }

    public function hydrate($value): SessionStore
    {
        return new SessionStore(
            $value['id'],
            $value['key'],
        );
    }
}
