@props([
    'current',
    'step-data',
])
@livewire($current, $this->getStepData(), key($current))
