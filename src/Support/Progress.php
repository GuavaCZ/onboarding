<?php

namespace Guava\Onboarding\Support;

use Guava\Onboarding\Enums\ProgressState;
use Illuminate\Support\Arr;

class Progress
{
    public function __construct(
        public string $step,
        public array $info,
        public ProgressState $state,
    ) {}

    public function isPrevious(): bool
    {
        return $this->state === ProgressState::Previous;
    }

    public function isCurrent(): bool
    {
        return $this->state === ProgressState::Current;
    }

    public function isNext(): bool
    {
        return $this->state === ProgressState::Next;
    }

    public function goTo(): string
    {
        return "goToStep('{$this->step}')";
    }

    public function __get(string $key): mixed
    {
        return Arr::get($this->info, $key);
    }
}
