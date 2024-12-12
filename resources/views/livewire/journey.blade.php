<x-guava-onboarding::wrapper :layout="$this->getLayout()">

    <x-guava-onboarding::progress :steps="$this->steps()" />

{{--    <livewire:dynamic-component :is="$current" :key="$current" />--}}
    @livewire($current, $this->getStepData(), key($current))
</x-guava-onboarding::wrapper>
