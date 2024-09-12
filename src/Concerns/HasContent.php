<?php

namespace Guava\Onboarding\Concerns;

use Closure;
use Filament\Support\Markdown;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

trait HasContent
{
    protected null | string | HtmlString | Closure $content = null;

    public function content(string | HtmlString | Closure $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): null|string|HtmlString
    {
        return new HtmlString(
            $this->evaluate($this->content)
        );
    }
}
