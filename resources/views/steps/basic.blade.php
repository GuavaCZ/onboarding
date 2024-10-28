<x-guava-onboarding::wrapper :layout="$layout">

    <x-guava-onboarding::progress
        :steps="$this->scenario->getSteps()"
        :current="$this->order"
    />
    @if($content = $step->getContent())
        <div class="prose prose-lg dark:prose-invert">
            {{$content}}
        </div>
    @endif

    <x-filament-panels::form.actions
        :actions="$this->getCachedFormActions()"
        :full-width="$this->hasFullWidthFormActions()"
    />

    @teleport('body')
    <x-filament-actions::modals />
    @endteleport

</x-guava-onboarding::wrapper>
