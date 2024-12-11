@props([
    'steps',
])
<div class="flex flex-row gap-2">
    @foreach($this->progress as $progress)
        <div @class([
            "rounded-full h-3",
            "bg-primary-400 dark:bg-primary-500 w-3" => $progress->isPrevious(),
            "bg-primary-400 dark:bg-primary-500 w-12" => $progress->isCurrent(),
            "bg-primary-200 dark:bg-primary-900 w-3" => $progress->isNext(),
        ])></div>
    @endforeach
</div>
