{{--<x-filament-panels::layout.base :livewire="$livewire">--}}
@props([
    'hasBrandLogo' => true,
    'hasTopbar' => true,
    'journeyInfo' => fluent([]),
    'stepInfo' => fluent([]),
    'footer' => null,
])

<div class="flex flex-col lg:flex-row lg:min-h-screen" xmlns:x-filament="http://www.w3.org/1999/html">

    @if (($hasTopbar) && filament()->auth()->check())
        <div
            class="absolute end-0 top-0 flex h-16 items-center gap-x-4 pe-4 md:pe-6 md:pe-8"
        >
            @if (filament()->hasDatabaseNotifications())
                @livewire(Filament\Livewire\DatabaseNotifications::class, ['lazy' => true])
            @endif

            <x-filament-panels::user-menu/>
        </div>
    @endif

    <div
        class="lg:sticky lg:top-0 flex flex-col items-center gap-16 lg:items-start lg:h-screen w-full lg:max-w-sm xl:max-w-md p-12 border-b lg:border-b-0 lg:border-r border-gray-950/5 dark:bg-gray-900 dark:border-white/10">
        @if ($hasBrandLogo)
            <img src="{{filament()->getDefaultPanel()->getBrandLogo()}}" class="block dark:hidden h-12"/>
            <img src="{{filament()->getDefaultPanel()->getDarkModeBrandLogo()}}" class="hidden dark:block h-12"/>
        @else
            <div></div>
        @endif
        <div class="flex flex-col gap-6 h-full">

            <x-guava-onboarding::progress/>
            <div class="flex flex-col items-start gap-1">
                @if($label = $journeyInfo->get('label'))
                <h2 class="text-primary-500 uppercase">{{$label}}</h2>
                @endif
                @if($label = $stepInfo->get('label'))
                    <h1 class="text-3xl">{{$label}}</h1>
                @endif
                @if ($stepInfo->get('optional'))
                    <x-filament::badge>Nepovinné</x-filament::badge>
                @endif
            </div>
            @if($html = $stepInfo->get('html'))
                {{$html}}
            @elseif($description = $stepInfo->get('description'))
                <div class="prose prose-lg dark:prose-invert">
                    {{$description}}
                </div>
            @endif
        </div>
            @if($footer)
                <x-guava-onboarding::footer class="hidden lg:flex"
                                            :actions="$footer->get('actions')"
                                            :copyright="$footer->get('copyright')"
                />
            @endif
    </div>
    <div class="w-full bg-white dark:bg-black">

        <div class="px-8 md:px-16 xl:px-32 2xl:px-64 py-16 lg:py-32 text-lg">
            {{--                {{ $this->step() }}--}}
            {{ $slot}}
        </div>

        @if($footer)
            <div
                class="border-t border-gray-950/5 dark:border-white/10 bg-gray-50 flex flex-col lg:hidden px-8 md:px-16 xl:px-32 2xl:px-64 py-8 gap-4">
                <x-guava-onboarding::footer :actions="$footer->get('actions')" :copyright="$footer->get('copyright')"/>
            </div>
        @endif
    </div>
</div>
{{--</x-filament-panels::layout.base>--}}
