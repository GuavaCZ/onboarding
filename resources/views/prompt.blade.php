<div class="flex flex-col gap-8 px-16 md:px-32 xl:px-64 py-32 bg-white text-lg">
    <div class="flex flex-row gap-2">
        @foreach($this->scenario->getSteps() as $current)
        <div @class([
            "rounded-full h-3",
            "bg-primary-400 w-3" => $loop->index < $this->step->getOrder(),
            "bg-primary-400 w-12" => $loop->index == $this->step->getOrder(),
            "bg-primary-200 w-3" => $loop->index > $this->step->getOrder(),
        ])></div>
        @endforeach
    </div>
    @if($content = $step->getContent())
        <div class="prose prose-lg">
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
