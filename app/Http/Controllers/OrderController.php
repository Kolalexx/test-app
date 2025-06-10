<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $product = Product::find($validated['product_id']);
        $validated['total_price'] = $product->price * $validated['quantity'];

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Заказ создан!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function complete(Order $order)
    {
        $order->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Заказ выполнен!');
    }
}
