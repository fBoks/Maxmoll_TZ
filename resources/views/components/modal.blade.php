@props(['button_text' => 'Подтвердить', 'id' => null])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="confirmationLabel">{{ __('Подтвердите действие') }}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
            <x-form {{ $attributes }}>
                <x-button type="submit" class="bg-primary border-primary" >
                    {{ $button_text }}
                </x-button>
            </x-form>
        </div>
        </div>
    </div>
</div>
