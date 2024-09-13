<x-filament-panels::layout.base :livewire="$livewire">
    <div class="flex flex-row min-h-screen">
        <div class="sticky top-0 flex flex-col gap-16 items-start h-screen w-full max-w-md p-12 border-r border-gray-950/5 dark:bg-gray-900 dark:border-white/10">
            <img src="{{filament()->getCurrentPanel()->getBrandLogo()}}" class="block dark:hidden h-12"/>
            <img src="{{filament()->getCurrentPanel()->getDarkModeBrandLogo()}}" class="hidden dark:block h-12"/>
            <div class="flex flex-col gap-6">
                <div class="flex flex-col items-start gap-1">
{{--                    <h2 class="text-primary-500 uppercase">{{$scenario->getLabel()}}</h2>--}}
                    <h1 class="text-3xl">{{$step->getLabel()}}</h1>
                    <x-filament::badge>Nepovinné</x-filament::badge>
                </div>
                @if($description = $step->getDescription())
                <div class="prose prose-lg dark:prose-invert">
                    {{ $description }}
                </div>
                @endif
            </div>
            <div class="text-sm flex flex-col gap-2 mt-auto mb-0">
                <div class="flex flex-row flex-wrap gap-4">
                    <a href="#">Home</a>
                    <a href="#">Terms and Conditions</a>
                    <a href="#">Logout</a>
                </div>
                <span class="text-gray-500">Copyright &copy; 2024 Bukli s.r.o. - All Rights Reserved.</span>
            </div>
        </div>
        <div class="w-full bg-white dark:bg-black">
            {{ $slot }}
        </div>
    </div>
</x-filament-panels::layout.base>
