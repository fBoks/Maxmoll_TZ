@props(['username' => null, 'id' => null])

<div class="modal modal-lg fade" id="{{ $id }}" tabindex="-1" aria-labelledby="confirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="confirmationLabel">{{ __('Подробная информация')}}</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $slot }}
        </div>
        </div>
    </div>
</div>
