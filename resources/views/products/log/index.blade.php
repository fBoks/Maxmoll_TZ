@extends('layouts.main')

@section('page.title', 'Движения')

@section('main.content')
    <div class="text-center mb-5">
        <div class="h2">
            {{ __('Движения') }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <span class="h3">{{ __('Список движений товаров') }}</span>
                            <a href="{{ route('products.log') }}"
                               class="align-content-center text-decoration-none">{{ __('Сбросить фильтр')  }}</a>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col" class="th-hover-overlay" id="idSortButton" data-sort="{{ $sortOrder }}">
                                #
                                @if($sortBy === 'idSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="orderSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Заказ') }}
                                @if($sortBy === 'orderSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="productSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Товар') }}
                                @if($sortBy === 'productSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="countSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Количество') }}
                                @if($sortBy === 'countSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="statusSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Вид') }}
                                @if($sortBy === 'statusSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productLogs as $log)
                            <tr class="position-relative
                                    @php
                                        if($log->status === 'Расход') echo('table-secondary');
                                        if($log->status === 'Приход') echo('table-success');
                                    @endphp
                                ">
                                <th scope="row">{{ $log->id }}</th>
                                <td>Заказ №{{ $log->order }}</td>
                                <td>{{ $log->product }}</td>
                                <td>{{ $log->count }}</td>
                                <td>{{ $log->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex">
                        {{ $productLogs->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('click', function (event) {
            if (
                event.target.id === 'idSortButton' ||
                event.target.id === 'orderSortButton' ||
                event.target.id === 'productSortButton' ||
                event.target.id === 'countSortButton' ||
                event.target.id === 'statusSortButton') {
                const currentSort = event.target.getAttribute('data-sort');
                const newSort = currentSort === 'asc' ? 'desc' : 'asc';

                const url = new URL(window.location.origin + window.location.pathname);

                url.searchParams.set((event.target.id).replace('Button', ''), newSort);

                const params = new URLSearchParams(window.location.search);
                const currentPage = params.get('page');

                if (currentPage) {
                    url.searchParams.set('page', currentPage);
                }

                window.location.href = url.href;
            }
        });
    </script>

@endpush
