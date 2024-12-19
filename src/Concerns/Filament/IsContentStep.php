<?php

namespace Guava\Onboarding\Concerns\Filament;

use Illuminate\Support\HtmlString;

trait IsContentStep
{
    use HasActions;

    abstract public function content(): string | HtmlString;

    public function render()
    {
        return view('guava-onboarding::steps.content');
    }
}
