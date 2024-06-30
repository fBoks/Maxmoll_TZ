@extends('layouts.main')

@section('page.title', 'Склады')

@section('main.content')
    <div class="text-center mb-5">
        <div class="h2">
            {{ __('Склады') }}
        </div>
    </div>

    <div class="d-flex flex-column gap-3 gap-md-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="h3">{{ __('Склады') }}</span>
                    <a href="{{ route('warehouses') }}">{{ __('Добавить склад') }}</a>
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

                <div class="d-flex">
                    {{ $warehouses->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
