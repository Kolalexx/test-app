@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1 class="mb-4">{{ $product->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Категория:</strong> {{ $product->category->name }}</p>
            <p><strong>Цена:</strong> {{ number_format($product->price, 2, '.', ' ') }} ₽</p>
            <p><strong>Описание:</strong> {{ $product->description ?? '—' }}</p>
            <div class="mt-3">
                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Редактировать</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
            </div>
        </div>
    </div>
@endsection
