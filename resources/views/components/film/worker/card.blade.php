@props(['routePath' => 'admin.films.workers.show', 'worker' => null, 'roles' => null, 'class' => ''])

<div class="d-flex justify-content-between gap-2 mb-4">
    <a href="{{ route('admin.films.workers.edit', $worker->id) }}" class="text-decoration-none flex-grow-1">
        <div class="card">
            <x-card-body class="{{$class}}">
                <div class="d-flex align-items-baseline justify-content-between gap-2 m-0">
                    <h2 class="h5 fw-normal text-primary">
                        {{ $worker->first_name }} {{ $worker->surname }} 
                    </h2>
                </div>

                <div class="">
                    @foreach ($worker->roles as $role)
                        <span class="text-secondary fs-6 me-2">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </div>
            </x-card-body>
        </div>
    </a>
</div>