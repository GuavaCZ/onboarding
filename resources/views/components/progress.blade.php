@props([
    'steps',
    'current' => 0
])
<div class="flex flex-row gap-2">
    @foreach($steps as $step)
        <div @class([
            "rounded-full h-3",
            "bg-primary-400 dark:bg-primary-500 w-3" => $loop->index < $current,
            "bg-primary-400 dark:bg-primary-500 w-12" => $loop->index == $current,
            "bg-primary-200 dark:bg-primary-900 w-3" => $loop->index > $current,
        ])></div>
    @endforeach
</div>
