<x-filament-widgets::widget>
    <x-filament::section>

        <div class="flex flex-col items-start gap-4">
            <div class="flex flex-row items-end gap-2">
                <x-filament::icon icon="heroicon-o-clipboard-document-list"
                                  class="shrink-0 w-12 h-12 text-primary-400 dark:text-primary-500"/>
                <span class="text-2xl font-bold">{{$scenario->getLabel()}}</span>
            </div>
            <div class="prose dark:prose-invert">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, ipsam, molestiae! Alias
                aliquam at aut consequuntur dolore esse id inventore necessitatibus nisi.
            </div>
            <x-filament::button tag="a" :href="$scenario->getSteps()->first()::getUrl([
            'scenario' => $scenario
            ])">Begin</x-filament::button>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
