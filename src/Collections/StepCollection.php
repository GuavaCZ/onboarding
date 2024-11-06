<?php

namespace Guava\Onboarding\Collections;

use Illuminate\Support\Collection;

class StepCollection extends Collection
{
    public function __construct($items = [])
    {
        parent::__construct($items);
    }
}
