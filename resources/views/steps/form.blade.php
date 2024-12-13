{{--<x-guava-onboarding::wrapper :layout="$layout">--}}

{{--    <x-guava-onboarding::progress--}}
{{--        :steps="$this->scenario->getSteps()"--}}
{{--        :current="$this->order"--}}
{{--    />--}}
{{--    @if($content = $step->getContent())--}}
{{--        <div class="prose prose-lg dark:prose-invert">--}}
{{--            {{$content}}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <x-filament-panels::form>--}}
{{--        {{$this->form}}--}}

{{--        <x-filament-panels::form.actions--}}
{{--            :actions="$this->getCachedFormActions()"--}}
{{--            :full-width="$this->hasFullWidthFormActions()"--}}
{{--        />--}}
{{--    </x-filament-panels::form>--}}

{{--    @teleport('body')--}}
{{--        <x-filament-actions::modals />--}}
{{--    @endteleport--}}
{{--</x-guava-onboarding::wrapper>--}}

<x-dynamic-component :component="$this->getLayout()">
    {{ $this->form }}

    <div class="mt-8">
        <x-filament::button wire:click.prevent="previousStep()">Previous step child</x-filament::button>
        <x-filament::button wire:click.prevent="nextStep()">Next step child</x-filament::button>
    </div>


    @teleport('body')
    <x-filament-actions::modals />
    @endteleport
</x-dynamic-component>
