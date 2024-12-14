<x-guava-onboarding::step>
    {{ $this->form }}

    <div class="mt-8">
        <button wire:click.prevent="test">test</button>
        <x-filament::button wire:click.prevent="previousStep()">Previous step</x-filament::button>
        <x-filament::button wire:click.prevent="nextStep()">Next step</x-filament::button>
    </div>

    @teleport('body')
    <x-filament-actions::modals />
    @endteleport
</x-guava-onboarding::step>
