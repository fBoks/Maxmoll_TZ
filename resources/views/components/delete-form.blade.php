<form method="POST" {{ $attributes->merge() }}>
    @csrf
    @method('DELETE')
    {{ $slot }}
</form>