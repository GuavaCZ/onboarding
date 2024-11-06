<?php

namespace Guava\Onboarding\Concerns;

trait HasPrefix
{
    protected string $prefix = 'onboarding';

    public function prefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }
}
