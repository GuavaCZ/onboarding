<?php

namespace Guava\Onboarding\Support;

use Guava\Onboarding\Contracts\Step;
use Illuminate\Support\Fluent;
use Illuminate\Support\Stringable;

class SessionStore
{
    //    public string $stateSessionKey;
    //
    //    public string $metaSessionKey;
    //

    protected ?string $group = null;

    protected ?string $key = null;

    public function __construct(
    ) {}

    public function group(string $group): static
    {
        $this->group = $group;

        return $this;
    }

    public function getGroup(): ?string
    {
        return $this->group;
    }

    public function key(?string $key): static
    {
        $this->key = $key;

        return $this;
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function global(): static
    {
        return $this->key(null);
    }

    public function state(null | array | string $state = null): Fluent
    {
        if (is_array($state)) {
            session()->put($this->getStateIdentifier(), $state);
        }

        $key = ! is_array($state) ? $state : null;

        return new Fluent(session()->get($this->getStateIdentifier($key)) ?? []);
    }

    public function meta(?array $meta = null): Fluent
    {
        if ($meta) {
            session()->put($this->getMetaIdentifier(), $meta);
        }

        return new Fluent(session()->get($this->getMetaIdentifier()) ?? []);
    }

    //    public function set(Step $step, array $data) {
    //        session()->put($this->getStateIdentifier($step), $data);
    //    }
    //
    protected function getStateIdentifier(?string $key = null): string
    {
        $key ??= $this->getKey();

        return str("{$this->group}.state")
            ->when(
                $key,
                fn (Stringable $str) => $str->append(".{$key}")
            )
        ;
    }

    protected function getMetaIdentifier(?string $key = null): string
    {
        return "{$this->group}.meta";
    }

    //        //        $this->state = str("{$this->group}.state");
    //
    //        $this->stateSessionKey = str("{$this->group}.state")
    //            ->when(
    //                $this->key,
    //                fn (Stringable $str) => $str->append(".{$this->key}")
    //            )
    //        ;
    //        $this->metaSessionKey = str("{$this->group}.meta");
    //    }
    //
    //    public function save(array $data): void
    //    {
    //        session()->put($this->stateSessionKey, $data);
    //    }
    //
    //    public function state(): Fluent
    //    {
    //        return fluent(session()->get($this->stateSessionKey) ?? []);
    //    }
    //
    //    public function stateForKey(string $key): Fluent {
    //        return fluent(session()->get("$this->group.state.$key"));
    //    }
    //
    //    public function meta(?array $data = null): Fluent
    //    {
    //        if ($data) {
    //            session()->put($this->metaSessionKey, $data);
    //        }
    //
    //        return fluent(session()->get($this->metaSessionKey) ?? []);
    //    }
    //
    public function clear(): void
    {
        session()->forget($this->group);
    }
}
