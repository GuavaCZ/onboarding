<x-guava-onboarding::step>
    {{ $this->infolist }}

    <x-guava-onboarding::actions :actions="$this->getActions()" />

    @teleport('body')
    <x-filament-actions::modals />
    @endteleport
</x-guava-onboarding::step>
