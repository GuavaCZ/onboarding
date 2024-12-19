<?php

namespace Guava\Onboarding\Filament;

use Filament\Support\Concerns\EvaluatesClosures;
use Filament\Support\Enums\Alignment;
use Guava\Onboarding\ConcernsOld\HasContent;
use Guava\Onboarding\ConcernsOld\HasDescription;
use Guava\Onboarding\ConcernsOld\HasLabel;

abstract class InfolistOnboard extends Onboard
{
    use EvaluatesClosures;
    use HasContent;
    use HasDescription;
    use HasLabel;

    public static string | Alignment $formActionsAlignment = Alignment::Right;

    protected static string $view = 'guava-onboarding::steps.infolist';
}
