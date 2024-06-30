@props(['routePath' => 'films.show', 'film' => null, 'genres' => null, 'class' => ''])

<a href="{{ route($routePath, $film->id) }}" class="text-decoration-none">
    <x-card>
        <x-card-body class="{{$class}}">
            <div class="d-flex align-items-baseline justify-content-between gap-2 m-0">
                <h2 class="h5 fw-normal text-primary">
                    {{ Illuminate\Support\Str::limit($film->name, 50) }}
                </h2>

                <div class="small text-secondary fs-6 fw-normal text-end"> 
                    {{ Illuminate\Support\Carbon::parse($film->realised_at)->format('Y') }} г.
                </div>
            </div>

            <div class="d-flex align-items-baseline justify-content-between gap-2 m-0">
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($film->genres as $genre)
                        <span class="text-secondary fs-6">
                            {{ $genre->name }}
                        </span>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end flex-wrap gap-1">
                    @foreach ($film->countries as $country)
                        <span class="text-secondary fs-6">
                            {{ $country->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </x-card-body>
    </x-card>
</a>