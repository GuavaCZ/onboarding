<x-guava-onboarding::step>
    {{ $this->content }}

    <x-guava-onboarding::actions :actions="$this->getActions()" />

    @teleport('body')
    <x-filament-actions::modals/>
    @endteleport
</x-guava-onboarding::step>
