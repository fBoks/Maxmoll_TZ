<div class="fs-5">
    <a {{ $attributes->merge([
        'href' => url()->previous(),
    ])->class([
        'text-decoration-none'
    ]) }}>
        {{ __('Назад') }}
    </a>
</div>