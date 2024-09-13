<?php

namespace Guava\Onboarding\Concerns;

use Guava\Onboarding\Filament\DefaultOnboardingPage;

trait HasPrompt
{
    protected string $prompt = DefaultOnboardingPage::class;

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
