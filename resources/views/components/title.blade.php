<div class="border-bottom pb-4 mb-4">
    @isset($link)
        <div class="mb-2">
            {{ $link }}
        </div>
    @endisset


    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h2 mb-0">
                {{ $slot }}
            </h1>
        </div>

        @isset($right)
            <div class="d-flex flex-md-row flex-column align-self-start gap-2">
                {{ $right }}
            </div>
        @endisset
    </div>
</div>

{{-- <x-errors /> --}}