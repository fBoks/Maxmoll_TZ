@props(['type' => 'alert-success'])

@if ($alert = session('alert'))
    @php($type = session('alertType'))

    <div class="alert {{$type}} alert-dismissible fade show text-center position-relative mb-0 rounded-0 small py-2" role="alert">
        {{ $alert }}
        <button type="button" class="btn-close small py-0 top-50 end-0 translate-middle" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif