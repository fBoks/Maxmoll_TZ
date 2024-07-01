@props(['order' => $order])

@extends('layouts.main')

@section('page.title', 'Заявка - редактирование')

@section('main.content')
    <div class="text-center mb-5">
        <div class="h2">
            {{ __('Редактирование') }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <span class="h3">{{ __('Заказ #') . $id }}</span>
                            <span class="badge rounded-pill
                                    @php
                                        if($order->status === 'active') echo(' bg-primary ');
                                        if($order->status === 'completed') echo(' bg-success ');
                                        if($order->status === 'canceled') echo(' bg-secondary ');
                                    @endphp
                                text-text-dark">{{ strtoupper($order->status) }}</span>
                            <a href="{{ route('orders.create') }}">{{ __('Новый заказ') }}</a>
                        </div>
                        @if($order->status === 'active')
                            <div class="d-flex gap-2">
                                <x-button class="bg-secondary border-secondary" data-bs-toggle="modal"
                                          data-bs-target="#confirmationModal_cancelOrder{{ $id }}">
                                    {{ __('Отменить') }}
                                </x-button>

                                <x-modal method="PUT"
                                         action="{{ route('orders.update', ['order_id' => $id, 'status' => 'canceled']) }}"
                                         id="confirmationModal_cancelOrder{{ $id }}">

                                    <div>
                                        {{ __('Вы действительно хотите отменить заказ?') }}
                                    </div>
                                </x-modal>

                                <x-button class="bg-success border-success" data-bs-toggle="modal"
                                          data-bs-target="#confirmationModal_completeOrder{{ $id }}">
                                    {{ __('Завершить') }}
                                </x-button>

                                <x-modal method="PUT"
                                         action="{{ route('orders.update', ['order_id' => $id, 'status' => 'completed']) }}"
                                         id="confirmationModal_completeOrder{{ $id }}">

                                    <div>
                                        {{ __('Вы действительно хотите завершить заказ?') }}
                                    </div>
                                </x-modal>
                            </div>
                        @else
                            <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#confirmationModal_recoverOrder{{ $id }}">
                                {{ __('Восстановить') }}
                            </button>

                            <x-modal method="PUT"
                                     action="{{ route('orders.update', ['order_id' => $id, 'status' => 'active']) }}"
                                     id="confirmationModal_recoverOrder{{ $id }}">

                                <div>
                                    {{ __('Вы действительно хотите восстановить заказ?') }}
                                </div>
                            </x-modal>
                        @endif
                    </div>

                    <x-form action="{{ route('orders.update', $id) }}" method="PUT" class="mb-4">
                        <x-form-item>
                            <x-label required>{{ __('Клиент ФИО') }}</x-label>
                            <input class="form-control" name="customer" value="{{ $order->customer }}"
                                   {{ $order->status === 'active' ?: 'disabled readonly' }} autofocus/>

                            <x-error name='customer'/>
                        </x-form-item>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <x-label required>{{ __('Склад') }}</x-label>
                                <select name="warehouse"
                                        class="form-select" {{ $order->status === 'active' ?: 'disabled readonly' }}>
                                    <option value="">{{ __('Выберите склад') }}</option>
                                    @foreach ($warehouses as $warehouse)
                                        {{ $selected = $order->warehouse_id === $warehouse->id ? 'selected' : null }}

                                        <option {{ $selected }} value="{{ $warehouse->id }}">
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-error name='warehouse'/>
                            </div>
                        </div>

                        <div class="row">
                            <button class="btn btn-primary"
                                    type="submit" {{ $order->status === 'active' ?: 'disabled' }}>
                                {{ __('Сохранить') }}
                            </button>
                        </div>
                    </x-form>

                    <x-form action="{{ route('orders.item.store', ['order_id' => $id]) }}" method="POST">
                        <div class="row">
                            <div class="col-md-5 col-12 mb-3">
                                <x-label required>{{ __('Товар') }}</x-label>
                                <select name="product"
                                        class="form-select" {{ $order->status === 'active' ? '' : 'disabled readonly' }}>
                                    <option value="">{{ __('Выберите товар') }}</option>
                                    @foreach ($products as $product)
                                        @if(empty($orderItems) || !$orderItems->contains('product_id', $product->id))
                                            {{ $selected = null }}

                                            <option {{ $selected }} value="{{ $product->id }}">
                                                {{ $product->name }} ({{ $product->stock }} шт.)
                                            </option>
                                        @endif
                                    @endforeach
                                </select>

                                <x-error name='product'/>
                            </div>

                            <div class="col-md-5 col-12 mb-3">
                                <x-form-item>
                                    <x-label required>{{ __('Количество') }}</x-label>
                                    <input class="form-control" type="number" name="count"
                                           {{ $order->status === 'active' ?: 'disabled readonly' }} autofocus/>

                                    <x-error name='count'/>
                                </x-form-item>
                            </div>
                            <div class="col-md-2 col-12 mb-3 d-flex align-items-center">
                                <button class="btn btn-primary"
                                        type="submit" {{ $order->status === 'active' ?: 'disabled' }}>
                                    {{ __('Добавить') }}
                                </button>
                            </div>
                        </div>
                    </x-form>

                    <div>
                        <div class="h4">{{ __('Товары в заказе') }}</div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Наименование') }}</th>
                                <th scope="col">{{ __('Цена') }}</th>
                                <th scope="col">{{ __('Количество') }}</th>
                                <th scope="col">{{ __('Сумма') }}</th>
                                <th scope="col">{{ __('Действие') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems as $item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->count }}</td>
                                    <td>{{ $item->price * $item->count }}</td>
                                    <td>
                                        @if( $order->status === 'active' && $orderItems->count() > 1)
                                            <span class="text-danger" style="cursor: pointer" data-bs-toggle="modal"
                                                  data-bs-target="#confirmationModal_deleteOrderItem{{ $item->id }}">
                                                {{ __('Удалить') }}
                                            </span>

                                            <x-modal method="DELETE"
                                                     action="{{ route('order.item.delete', ['order_id' => $id, 'item_id' => $item->id]) }}"
                                                     id="confirmationModal_deleteOrderItem{{ $item->id }}">

                                                <div>
                                                    {{ __('Вы действительно хотите удалить товар из заказа?') }}
                                                </div>
                                            </x-modal>
                                        @else
                                            <span class="text-secondary" style="cursor: not-allowed">
                                                {{ __('Удалить') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
