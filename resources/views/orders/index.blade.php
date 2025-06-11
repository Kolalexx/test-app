@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
    <h1 class="mb-4">Список заказов</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Создать заказ</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Покупатель</th>
            <th>Статус</th>
            <th>Итоговая цена</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>
                        <span class="badge bg-{{ $order->status == 'new' ? 'warning' : 'success' }}">
                            {{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}
                        </span>
                </td>
                <td>{{ number_format($order->total_price, 2, '.', ' ') }} ₽</td>
                <td>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">Просмотр</a>
                    @if($order->status == 'new')
                        <form action="{{ route('orders.complete', $order) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Завершить</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
@endsection
