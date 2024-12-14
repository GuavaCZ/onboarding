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

<x-guava-onboarding::step>
    {{--<div>--}}
    @if($content = $this->getContent())
        <div class="prose prose-lg dark:prose-invert">
            {{$content}}
        </div>
    @endif

    <div class="mt-8">
        <button wire:click.prevent="test">test</button>
        <x-filament::button wire:click.prevent="previousStep()">Previous step child</x-filament::button>
        <x-filament::button wire:click.prevent="nextStep()">Next step child</x-filament::button>
    </div>
</x-guava-onboarding::step>
