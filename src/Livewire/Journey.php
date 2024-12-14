<?php

namespace Guava\Onboarding\Livewire;

use Guava\Onboarding\Concerns\IsJourney;
use Guava\Onboarding\Contracts\Journey as JourneyContract;
use Livewire\Component;

abstract class Journey extends Component implements JourneyContract
{
    use IsJourney;
}
