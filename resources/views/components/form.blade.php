@props(['method' => 'POST'])

@php($method = strtoupper($method))
@php($_method = in_array($method, ['GET', 'POST'])) {{-- true - если в $method лежит GET\POST, false - если там лежат другие методы (строки)  --}}

<form {{ $attributes }} method="{{ $_method ? $method : 'POST' }}">
    @unless ($_method)
        @method($method) {{-- равносильно <input type="hidden" name="_method" method="{{ $method }}" /> --}}
    @endunless

    @unless ($method === 'GET')
        @csrf
    @endunless {{ $slot }}
</form>