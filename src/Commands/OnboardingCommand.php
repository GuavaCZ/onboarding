<?php

namespace Guava\Onboarding\Commands;

use Illuminate\Console\Command;

class OnboardingCommand extends Command
{
    public $signature = 'onboarding';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
