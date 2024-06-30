@props(['routePath' => 'blog.show', 'post' => null, 'class' => ''])

<a href="{{ route($routePath, $post->id) }}" class="text-decoration-none">
    <x-card>
        <x-card-body class="{{ $class }}">
            <div class="d-flex align-items-baseline justify-content-between gap-md-2 gap-0 m-0">
                <h2 class="h5 fw-normal text-primary w-75 text-break">
                    {{ Illuminate\Support\Str::limit($post->title, 40) }}
                </h2>

                <div class="small text-secondary fs-6 fw-normal text-end flex"> 
                    {{ $post->published_at?->diffForHumans() }}
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex gap-2 text-secondary fs-6">
                    <span>
                        {{ $post->category }}
                    </span>
                    
                    <span>—</span>

                    <span>
                        {{ Illuminate\Support\Str::limit($post->film, 50) }}
                    </span>
                </div>

                <div class="small text-secondary">
                    {{ $post->user_login }}
                </div>
            </div>
        </x-card-body>
    </x-card>
</a>