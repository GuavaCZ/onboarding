<?php

namespace Guava\Onboarding\ValueObjects;

use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\ConcernsOld\HasDescription;
use Guava\Onboarding\ConcernsOld\HasLabel;

class ContentData
{
    use EvaluatesClosures;
    use HasDescription;
    use HasLabel;

    public static function make(): static
    {
        return app(static::class);
    }
}
