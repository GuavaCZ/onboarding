<div class="flex flex-col gap-8 px-16 md:px-32 xl:px-64 py-32 text-lg">

    <x-guava-onboarding::progress
        :steps="$this->scenario->getSteps()"
        :current="$this->order"
    />
    @if($content = $step->getContent())
        <div class="prose prose-lg dark:prose-invert">
            {{$content}}
        </div>
    @endif

    <x-filament-panels::form>
        {{$this->form}}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    <x-filament-actions::modals />
</div>
