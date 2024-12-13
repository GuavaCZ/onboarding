<?php

namespace Guava\Onboarding\Support;

class StepInfo
{
    public function __construct(
        public string $label,
        public string $description,
        public bool $optional = false,
    ) {}
}
