<div>

@if($this->currentStep)
        @livewire($this->currentStep, [
        ...$this->getStepData(),
        'current' => $this->currentStep,
        'journey-info' => $this->getJourneyInfo(),
        'steps' => $this->steps(),
    ], key($this->currentStep))
@endif
</div>
