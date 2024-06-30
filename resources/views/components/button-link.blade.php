@props(['btnClass' => ''])

<a {{ $attributes }}>
    <x-button class="{{ $btnClass }}">
        {{ $slot }}
    </x-button>
</a>