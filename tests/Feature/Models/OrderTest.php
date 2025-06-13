<?php

namespace Tests\Feature\Models;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_total_calculation()
    {
        $order = Order::factory()->create(['quantity' => 2]);

        $expectedTotal = $order->product->price * 2;

        $this->assertEquals($expectedTotal, $order->total_price);
    }
}
