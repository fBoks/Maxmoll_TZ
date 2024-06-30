@props(['value' => null, 'options' => [], 'nullOptionName' => '-'])

<select {{ $attributes->class([
    'form-select',
]) }}>
    <option value="" {{ $value ? null : 'selected' }}>
        {{ $nullOptionName }}
    </option>

    @foreach ($options as $key)
        <option value="{{ $key->id }}" {{ $key->id == $value ? 'selected' : null }}> {{-- сверка id категории option с той, которая приходит из запроса --}}
            {{ $key->name }}
        </option>
    @endforeach
</select>