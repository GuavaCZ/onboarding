<div>
@if($this->currentStep)
        @livewire($this->currentStep, [
        ...$this->getStepData(),
        'currentStep' => $this->currentStep,
        'reachedStep' => $this->reachedStep,
//        'journey-info' => $this->getJourneyInfo(),
        'steps' => $this->steps(),
    ], key($this->currentStep))
@endif
</div>
