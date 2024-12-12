{{--<x-filament-panels::layout.base :livewire="$livewire">--}}
    <div class="flex flex-col lg:flex-row lg:min-h-screen">

        @if (($hasTopbar ?? true) && filament()->auth()->check())
            <div
                class="absolute end-0 top-0 flex h-16 items-center gap-x-4 pe-4 md:pe-6 md:pe-8"
            >
                @if (filament()->hasDatabaseNotifications())
                    @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
                @endif

                <x-filament-panels::user-menu />
            </div>
        @endif

        <div class="lg:sticky lg:top-0 flex flex-col items-center gap-16 lg:items-start lg:h-screen w-full lg:max-w-sm xl:max-w-md p-12 border-b lg:border-b-0 lg:border-r border-gray-950/5 dark:bg-gray-900 dark:border-white/10">
            <img src="{{filament()->getCurrentPanel()->getBrandLogo()}}" class="block dark:hidden h-12"/>
            <img src="{{filament()->getCurrentPanel()->getDarkModeBrandLogo()}}" class="hidden dark:block h-12"/>
            <div class="flex flex-col gap-6">
                <div class="flex flex-col items-start gap-1">
                    <h2 class="text-primary-500 uppercase">Scenario Label</h2>
                    <h1 class="text-3xl">Step label</h1>
                    <x-filament::badge>Nepovinné</x-filament::badge>
                </div>
{{--                @if($description = $step->getDescription())--}}
                <div class="prose prose-lg dark:prose-invert">
                    Step description
                </div>
{{--                @endif--}}
            </div>
            <x-guava-onboarding::footer class="hidden lg:flex" />
        </div>
        <div class="w-full bg-white dark:bg-black">
{{--            @dd($this)--}}
            @livewire($current, $this->getStepData(), key($current))
{{--            {{ $slot }}--}}

            <div class="border-t border-gray-950/5 dark:border-white/10 bg-gray-50 flex flex-col lg:hidden px-8 md:px-16 xl:px-32 2xl:px-64 py-8 gap-4">
                <x-guava-onboarding::footer />
            </div>
        </div>
    </div>
{{--</x-filament-panels::layout.base>--}}
