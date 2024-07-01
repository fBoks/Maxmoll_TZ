<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-sm container-md container-xl">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('home') }}">{{ __('Главная') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders')  }}">{{ __('Заказы') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products') }}">{{ __('Товары') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('warehouses')  }}">{{ __('Склады') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.log')  }}">{{ __('Движения') }}</a>
                </li>
            </ul>
        </nav>
    </div>
</nav>

@once
    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}">
    @endpush
@endonce
