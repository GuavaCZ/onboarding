<?php

namespace Guava\Onboarding\Support;

use Illuminate\Support\HtmlString;

class StepInfo
{
    public function __construct(
        public string $label,
        public string | HtmlString $description,
        public bool $optional = false,
    ) {}
}
