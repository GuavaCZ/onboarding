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

    <div>
        @foreach($this->getCachedInfolists() as $infolist)
        {{$infolist}}
        @endforeach
    </div>
    <x-filament-panels::form>
        {{$this->form}}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    @teleport('body')
    <x-filament-actions::modals />
    @endteleport
</x-guava-onboarding::wrapper>
