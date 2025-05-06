<?php

namespace Guava\Onboarding\Concerns;

use Guava\Onboarding\Support\SessionStore;

trait InteractsWithStore
{
    public function store(): SessionStore
    {
        return $this->getStore($this->makeStore());
    }

    abstract protected function getStore(SessionStore $store): SessionStore;

    abstract protected function makeStore(): SessionStore;
}
