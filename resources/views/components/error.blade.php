@props(['name' => ''])

@error($name)
    <div {{ $attributes->class([
        'small', 'text-danger', 'pt-1',
        ]) }}
    >
        {{ $message }}
    </div>
@enderror
