@php
    $productsSum = 0;
@endphp

@extends('layouts.main')

@section('page.title', 'Главная страница')

@section('main.content')
    <div class="text-center mb-5">
        <div class="h2">
            {{ __('Главная страница') }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="h3">{{ __('Товары') }}</span>
                        <a href="{{ route('products') }}">{{ __('Показать все') }}</a>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Наименование') }}</th>
                            <th scope="col">{{ __('Цена') }}</th>
                            <th scope="col">{{ __('Остаток') }}</th>
                            <th scope="col">{{ __('Сумма') }}</th>
                            <th scope="col">{{ __('Склад') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->price * $product->stock }}</td>
                                <td>{{ $product->warehouse_name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th scope="row">...</th>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                            <td>...</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="h3">{{ __('Склады') }}</span>
                        <a href="{{ route('warehouses') }}">{{ __('Показать все') }}</a>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Наименование') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($warehouses as $warehouse)
                            <tr>
                                <th scope="row">{{ $warehouse->id }}</th>
                                <td>{{ $warehouse->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('click', function (event) {
            if (event.target.id === 'dateSortButton' || event.target.id === 'emailSortButton' || event.target.id === 'userSortButton') {
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
