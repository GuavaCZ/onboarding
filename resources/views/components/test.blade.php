<div>
    @if($this->currentStep)
        @livewire($currentStep, [
        ...$this->getStepData(),
        'current' => $currentStep,
        'journey-info' => $this->getJourneyInfo(),
        'steps' => $this->steps(),
    ], key($currentStep))
    @endif
</div>
