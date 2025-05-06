@props([
    'actions' => [],
    'copyright' => new \Illuminate\Support\HtmlString('Copyright &copy; ' . date('Y') . ' ' . config('app.name') . ' - All Rights Reserved.'),
])
<div {{$attributes->class(["text-sm flex flex-col gap-2 mt-auto mb-0"])}}>
    @if(!empty($actions))
        <div class="flex flex-row flex-wrap gap-4">
            @foreach($actions as $action)
                <a href="{{$action['url']}}">{{$action['label']}}</a>
            @endforeach
        </div>
    @endif
    @if($copyright)
        <span class="text-gray-500">{{$copyright}}</span>
    @endif
</div>
