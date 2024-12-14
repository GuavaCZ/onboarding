<x-dynamic-component :component="$this->getLayout()" {{$attributes->merge($this->getLayoutData())}}>
    {{ $slot }}
</x-dynamic-component>
