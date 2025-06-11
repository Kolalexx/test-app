@extends('layouts.app')

@section('title', 'Заказ #' . $order->id)

@section('content')
    <h1 class="mb-4">Заказ #{{ $order->id }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Покупатель:</strong> {{ $order->customer_name }}</p>
            <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Статус:</strong>
                <span class="badge bg-{{ $order->status == 'new' ? 'warning' : 'success' }}">
                    {{ $order->status == 'new' ? 'Новый' : 'Выполнен' }}
                </span>
            </p>
            <p><strong>Товар:</strong> {{ $order->product->name }}</p>
            <p><strong>Количество:</strong> {{ $order->quantity }}</p>
            <p><strong>Цена за единицу:</strong> {{ number_format($order->product->price, 2, '.', ' ') }} ₽</p>
            <p><strong>Итоговая цена:</strong> {{ number_format($order->total_price, 2, '.', ' ') }} ₽</p>
            <p><strong>Комментарий:</strong> {{ $order->comment ?? '—' }}</p>

            <div class="mt-3">
                @if($order->status == 'new')
                    <form action="{{ route('orders.complete', $order) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Завершить заказ</button>
                    </form>
                @endif
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Назад</a>
            </div>
        </div>
    </div>
@endsection
