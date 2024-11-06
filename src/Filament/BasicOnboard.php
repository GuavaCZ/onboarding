<?php

namespace Guava\Onboarding\Filament;

use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasContent;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasLabel;

abstract class BasicOnboard extends Onboard
{
    use EvaluatesClosures;
    use HasContent;
    use HasDescription;
    use HasLabel;

    protected static string $view = 'guava-onboarding::steps.basic';

    public function mount(): void
    {
        parent::mount();
    }
}
