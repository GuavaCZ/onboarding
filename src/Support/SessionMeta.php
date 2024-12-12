<?php

namespace Guava\Onboarding\Support;

use Illuminate\Support\Stringable;

class SessionMeta
{
    public string $state;

    public string $data;

    public function __construct(
        public string $group,
        public ?string $key = null,
    ) {
        $this->state = str("{$this->group}.state");

        $this->data = str($this->state)
            ->when(
                $this->key,
                fn (Stringable $str) => $str->append(".{$this->key}")
            )
        ;
    }

    public function clear()
    {
        session()->forget($this->group);
    }
}
