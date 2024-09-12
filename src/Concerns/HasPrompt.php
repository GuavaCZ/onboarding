<?php

namespace Guava\Onboarding\Concerns;

use Guava\Onboarding\Filament\DefaultPrompt;

trait HasPrompt
{
    protected string $prompt = DefaultPrompt::class;

    public function prompt(string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getPrompt(): string
    {
        return $this->evaluate($this->prompt);
    }
}
