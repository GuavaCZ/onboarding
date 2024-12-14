<x-guava-onboarding::step>
    {{ $this->infolist }}

    <x-guava-onboarding::actions />
    <div class="mt-8">
        <x-filament::button wire:click.prevent="previousStep()">Previous step child</x-filament::button>
        <x-filament::button wire:click.prevent="nextStep()">Next step child</x-filament::button>
    </div>

    @teleport('body')
    <x-filament-actions::modals />
    @endteleport
</x-guava-onboarding::step>
