@extends('layouts.main')

@section('page.title', 'Заказы')

@section('main.content')
    <div class="text-center mb-5">
        <div class="h2">
            {{ __('Заказы') }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <span class="h3">{{ __('Список заказов') }}</span>
                            <a href="{{ route('orders') }}"
                               class="align-content-center text-decoration-none">{{ __('Сбросить фильтр')  }}</a>
                        </div>
                        <a href="{{ route('orders.create') }}">{{ __('Добавить заказ') }}</a>
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
                            <th scope="col" class="th-hover-overlay" id="clientSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Клиент') }}
                                @if($sortBy === 'clientSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="createdAtSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Создан') }}
                                @if($sortBy === 'createdAtSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="completedAtSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Завершен') }}
                                @if($sortBy === 'completedAtSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="warehouseSortButton"
                                data-sort="{{ $sortOrder }}">
                                {{ __('Склад') }}
                                @if($sortBy === 'warehouseSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col" class="th-hover-overlay" id="statusSortButton" data-sort="{{ $sortOrder }}">
                                {{ __('Статус') }}
                                @if($sortBy === 'statusSort')
                                    {{ $sortOrder === 'asc' ? '↓' : '↑' }}
                                @endif
                            </th>
                            <th scope="col">{{ __('Действие') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr class="position-relative
                                    @php
                                        if($order->status === 'completed') echo('table-success');
                                        if($order->status === 'canceled') echo('table-secondary');
                                    @endphp
                                ">
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->customer }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->completed_at ?? '-' }}</td>
                                <td>{{ $order->warehouse_name }}</td>
                                <td>{{ $order->status }}</td>
                                <td><a class="stretched-link text-decoration-none text-primary"
                                       href="{{ route('orders.edit', ['order_id' => $order->id]) }}">{{ __('Изменить') }}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex">
                        {{ $orders->links('vendor.pagination.custom') }}
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
                event.target.id === 'clientSortButton' ||
                event.target.id === 'createdAtSortButton' ||
                event.target.id === 'completedAtSortButton' ||
                event.target.id === 'warehouseSortButton' ||
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
