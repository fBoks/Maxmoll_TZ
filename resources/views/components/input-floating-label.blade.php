@props(['id' => ''])

<div class="form-floating">
    <x-input {{ $attributes->merge([
        'id' => $id,
    ]) }} />
    <label for="{{ $id }}">{{ $slot }}</label>
</div>