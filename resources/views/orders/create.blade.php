@extends('layouts.main')

@section('page.title', 'Заказ - создание')

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
                        <span class="h3">{{ __('Новый заказ') }}</span>
                        <a href="{{ route('orders') }}">{{ __('Все заказы') }}</a>
                    </div>

                    <x-form action="{{ route('orders.store') }}" method="POST">
                        <x-form-item>
                            <x-label required>{{ __('Клиент ФИО') }}</x-label>
                            <x-input name="customer" autofocus/>

                            <x-error name='customer'/>
                        </x-form-item>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <x-label required>{{ __('Склад') }}</x-label>
                                <select name="warehouse" class="form-select">
                                    <option value="">{{ __('Выберите склад') }}</option>
                                    @foreach ($warehouses as $warehouse)
                                        {{ $selected = null }}

                                        <option {{ $selected }} value="{{ $warehouse->id }}">
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-error name='warehouse'/>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <x-label required>{{ __('Товар') }}</x-label>
                                <select name="product" class="form-select">
                                    <option value="">{{ __('Выберите товар') }}</option>
                                    @foreach ($products as $product)
                                        {{ $selected = null }}

                                        <option {{ $selected }} value="{{ $product->id }}">
                                            {{ $product->name }} ({{ $product->stock }} шт.)
                                        </option>
                                    @endforeach
                                </select>

                                <x-error name='product'/>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <x-form-item>
                                    <x-label required>{{ __('Количество') }}</x-label>
                                    <x-input type="number" name="count" autofocus/>

                                    <x-error name='count'/>
                                </x-form-item>
                            </div>

                            <span class="text-secondary mb-3">
                                {{ __('Добавление других товаров доступно после создания заказа') }}
                            </span>
                        </div>

                        <div class="row ps-2 pe-2 pb-2">
                            <x-button type="submit">
                                {{ __('Создать') }}
                            </x-button>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection
