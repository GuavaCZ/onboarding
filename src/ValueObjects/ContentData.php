<?php

namespace Guava\Onboarding\ValueObjects;

use Filament\Support\Concerns\EvaluatesClosures;
use Guava\Onboarding\Concerns\HasDescription;
use Guava\Onboarding\Concerns\HasLabel;

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
