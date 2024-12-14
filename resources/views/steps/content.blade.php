<x-guava-onboarding::step>
        <div class="prose prose-lg dark:prose-invert">
            {{$this->content()}}
        </div>

    <x-guava-onboarding::actions :actions="$this->getActions()" />
</x-guava-onboarding::step>
