<?php

namespace Guava\Onboarding\Support;

use Guava\Onboarding\Filament\Journey;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class JourneyMeta
{
    public function __construct(
        public string $currentStep,
    ) {}

    public static function load(Journey $journey): JourneyMeta
    {
        $data = Session::get("journey.{$journey->key()}.meta") ?? [];
        $currentStep = $data['currentStep'] ?? Arr::first($journey->steps());

        return new JourneyMeta($currentStep);
    }

    public static function save(Journey $journey, string $next)
    {
        Session::put("journey.{$journey->key()}.meta", [
            'currentStep' => $next,
        ]);
    }
}
