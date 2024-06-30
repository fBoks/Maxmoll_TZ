<input type="hidden" {{ $attributes }} id="{{ $name }}"/>
<trix-editor input="{{ $name }}"></trix-editor>

@once
    @push('css')
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    @endpush

    @push('js')
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    @endpush
@endonce