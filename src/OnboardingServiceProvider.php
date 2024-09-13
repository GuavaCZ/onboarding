<?php

namespace Guava\Onboarding;

use Guava\Onboarding\Filament\FormOnboard;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Guava\Onboarding\Commands\OnboardingCommand;

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

    public function packageRegistered()
    {
//        Livewire::component(FormOnboard::class);
    }
}
