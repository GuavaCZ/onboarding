<div>
    Current: {{$current}}
    <livewire:dynamic-component :is="$current" :key="$current" />

    <button wire:click.prevent="nextStep()">Next step</button>

    <div>
        SESSION ({{ $this->key() }}):
    @dump(\Illuminate\Support\Facades\Session::get($this->key()))
    </div>
</div>
