<?php

namespace Guava\Onboarding\Concerns;

use Closure;
use Illuminate\Support\HtmlString;

trait HasDescription
{
    protected null | string | HtmlString | Closure $description = null;

    public function description(string | HtmlString | Closure $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): null | string | HtmlString
    {
        return new HtmlString(
            $this->evaluate($this->description) ?? ''
        );
    }
}
