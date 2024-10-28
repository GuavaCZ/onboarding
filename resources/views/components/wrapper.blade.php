@props([
    'layout'
])
<div @class([
    "flex flex-col gap-8",
    "px-8 md:px-16 xl:px-32 2xl:px-64 py-16 lg:py-32 text-lg" => $layout === 'guava-onboarding::layouts.default'
])>
    {{ $slot }}
</div>
