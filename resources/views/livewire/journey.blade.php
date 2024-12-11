<div>
    Current: {{$current}}
    <livewire:dynamic-component :is="$current" :key="$current" />

    <div>
        SESSION ({{ $this->key() }}):
    @dump(\Illuminate\Support\Facades\Session::get($this->key()))
        @dump(\Illuminate\Support\Facades\Session::all())
    </div>
</div>
