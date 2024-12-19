<?php

namespace Guava\Onboarding;

use Guava\Onboarding\Commands\OnboardingCommand;
use Guava\Onboarding\Filament\FormOnboard;
use Guava\Onboarding\Filament\ScenarioWidget;
use Guava\Onboarding\Support\JourneyMetaSynth;
use Guava\Onboarding\Support\ProgressSynth;
use Guava\Onboarding\Support\SessionMetaSynth;
use Guava\Onboarding\Support\StepInfoSynth;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OnboardingServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('guava-onboarding')
//            ->hasConfigFile()
            ->hasViews()
//            ->hasMigration('create_onboarding_table')
//            ->hasCommand(OnboardingCommand::class)
        ;
    }

    public function packageBooted()
    {
        Livewire::component('scenario-widget', ScenarioWidget::class);
        //        Livewire::component(FormOnboard::class);
    }

    public function bootingPackage()
    {
        Livewire::propertySynthesizer(ProgressSynth::class);
        Livewire::propertySynthesizer(JourneyMetaSynth::class);
        Livewire::propertySynthesizer(SessionMetaSynth::class);
        Livewire::propertySynthesizer(StepInfoSynth::class);
    }
}
