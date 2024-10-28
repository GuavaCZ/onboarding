@php
    $scenario = $this->getScenario();
@endphp

<x-filament-panels::page
    @class([
        'fi-resource-list-records-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])
>
    <div class="flex flex-col gap-y-6">
        <x-filament-panels::resources.tabs />

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE, scopes: $this->getRenderHookScopes()) }}

        <x-filament::section>
            <x-filament-tables::empty-state
                icon="heroicon-o-x-mark"
                :heading="$scenario->getAlertContent()->getLabel()"
            :description="$scenario->getAlertContent()->getDescription()"
                :actions="[
                \Filament\Actions\Action::make('begin')
                ]"
            >

            </x-filament-tables::empty-state>
        </x-filament::section>

        {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER, scopes: $this->getRenderHookScopes()) }}
    </div>
</x-filament-panels::page>
