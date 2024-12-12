<?php

namespace Guava\Onboarding\Filament;

use Filament\Pages\SimplePage;
use Filament\Support\Exceptions\Halt;
use Guava\Onboarding\Filament\Concerns\TracksProgress;
use Guava\Onboarding\Support\JourneyMeta;
use Guava\Onboarding\Support\SessionMeta;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

abstract class Journey extends SimplePage
{
}
